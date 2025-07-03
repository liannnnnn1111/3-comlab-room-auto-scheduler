<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Auto Scheduler Timetable</title>
    <!-- Bootstrap CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
      table {
    border-collapse: collapse;
    width: 100%;
}

th, td {
    border: 2px solid black !important;
    padding: 8px;
    text-align: center !important; /* Center text horizontally */
    vertical-align: middle !important; /* Center text vertically */
}

th {
    background-color: green !important;
    color: white !important;
    border: 3px solid black !important;
}

td {
    height: 50px !important;
}

.time-slot {
    background-color: #f9f9f9 !important;
}

.time-slot:hover {
    background-color: #e0e0e0 !important;
}

.hidden-cell {
    display: none !important;
}

.container {
    margin-top: 20px !important;
}

    </style>
</head>
<body>
    <div id="schedule" class="container" style="display: none;">
        <h1 class="text-center my-4">Auto Scheduler Timetable</h1>

        <!-- Room Selection Dropdown -->
        <div class="form-group">
            <label for="roomDropdown">Select Computer Lab:</label>
            <select id="roomDropdown" class="form-control">
                <option value="schedules_cl1">Computer Lab 1 </option>
                <option value="schedules_cl2">Computer Lab 2 </option>
                <option value="schedules_cl3">Computer Lab 3 </option>
            </select>
        </div>

        <!-- Timetable Structure -->
        <table class="table table-bordered timetable">
            <thead class="thead-dark">
                <tr>
                    <th>Time</th>
                    <th>Monday</th>
                    <th>Tuesday</th>
                    <th>Wednesday</th>
                    <th>Thursday</th>
                    <th>Friday</th>
                    <th>Saturday</th>
                    <th>Sunday</th>
                </tr>
            </thead>
            <tbody>
                <?php
                for ($hour = 6; $hour <= 22; $hour++) {
                    for ($half = 0; $half < 2; $half++) {
                        $time = sprintf('%02d:%02d', $hour, $half * 30);  // Generate time slots
                        echo "<tr>";
                        echo "<td>{$time}</td>";  // Time column
                        foreach (['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'] as $day) {
                            echo "<td class='{$day} time-slot'></td>";  // Empty cell for each day
                        }
                        echo "</tr>";
                    }
                }
                ?>
            </tbody>
        </table>
    </div>

    <!-- JQuery and Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <!-- AJAX and Timetable Handling -->
    <script>
        $(document).ready(function() {
            retrieve();  // Initial timetable load

            // Event listener for room selection
            $('#roomDropdown').change(function() {
                retrieve();
            });
        });

        function retrieve() {
            var room = $('#roomDropdown').val();

            clearTimetable(); // Clear all cells

            $.ajax({
                type: 'POST',
                url: 'http://localhost/sched/1/admin/controller.php',  // Ensure this is the correct URL
                data: { action: 'fetch_schedules', room: room },
                dataType: 'json',
                success: function(response) {
                    console.log('Response:', response);

                    if (response.error) {
                        console.error('Error:', response.error);
                        alert('Failed to fetch schedules: ' + response.error);
                        return;
                    }

                    if (!Array.isArray(response) || response.length === 0) {
                        alert('No schedules available for the selected room.');
                        return;
                    }

                    updateTimetable(response);
                },
                error: function(xhr, status, error) {
                    console.error('AJAX Error:', status, error);
                    alert('AJAX Error: ' + error);
                }
            });
        }

        function clearTimetable() {
            $('.time-slot').each(function() {
                $(this).html(''); // Clear cell content
                $(this).removeAttr('rowspan'); // Remove rowspan attribute
                $(this).removeClass('hidden-cell'); // Ensure hidden cells are visible
            });
        }

        function updateTimetable(schedules) {
            var dayMapping = {
                'Monday': 'Monday',
                'Tuesday': 'Tuesday',
                'Wednesday': 'Wednesday',
                'Thursday': 'Thursday',
                'Friday': 'Friday',
                'Saturday': 'Saturday',
                'Sunday': 'Sunday'
            };

            schedules.forEach(function(schedule) {
                var day = schedule.day;
                var start_time = schedule.start_time;
                var end_time = schedule.end_time;
                var subject = schedule.subject;

                var dayFullName = dayMapping[day] || day;  // Map day abbreviation to full name if needed
                var startIndex = timeToIndex(start_time);
                var endIndex = timeToIndex(end_time);

                var span = endIndex - startIndex;  // Calculate how many slots the subject spans

                console.log('Day:', dayFullName, 'Start:', startIndex, 'End:', endIndex, 'Span:', span); // Debug output

                var dayCells = $('.' + dayFullName);  // Directly select the day column
                if (dayCells.length === 0) {
                    console.warn('No cells found for day:', dayFullName);
                    return;
                }

                // Apply rowspan to the first slot and hide the rest
                if (span > 0) {
                    $(dayCells[startIndex]).html(subject);
                    $(dayCells[startIndex]).attr('rowspan', span);  // Set rowspan attribute

                    // Hide the subsequent cells that the subject spans
                    for (var i = startIndex + 1; i < endIndex; i++) {
                        $(dayCells[i]).addClass('hidden-cell');  // Use CSS class to hide cells
                    }
                }
            });
        }

        function timeToIndex(time) {
            var parts = time.split(':');
            var hour = parseInt(parts[0]);
            var minute = parseInt(parts[1]);
            return (hour - 6) * 2 + (minute === 30 ? 1 : 0);
        }
      
    </script>
</body>
</html>
