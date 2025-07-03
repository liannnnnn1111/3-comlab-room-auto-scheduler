<?php
include 'connect.php'; // Ensure this path is correct

// Function to validate room names
function isValidRoom($room) {
    $validRooms = ['schedules_cl1', 'schedules_cl2', 'schedules_cl3'];
    return in_array($room, $validRooms);
}

// Fetch schedules logic
if (isset($_POST['action']) && $_POST['action'] == 'fetch_schedules') {
    $room = $_POST['room'];  // Get the room selected

    // Validate room value
    if (!isValidRoom($room)) {
        header('Content-Type: application/json');
        echo json_encode(['error' => 'Invalid room']);
        exit();
    }

    // Query to fetch schedules from the respective room table
    try {
        $stmt = $conn->prepare("SELECT subject, start_time, end_time, day, units FROM $room");
        $stmt->execute();
        $result = $stmt->get_result();

        $schedules = [];
        while ($row = $result->fetch_assoc()) {
            $schedules[] = [
                'subject' => $row['subject'],
                'start_time' => $row['start_time'],
                'end_time' => $row['end_time'],
                'day' => $row['day'],
                'units' => $row['units']
            ];
        }

        header('Content-Type: application/json');
        echo json_encode($schedules);
    } catch (Exception $e) {
        error_log($e->getMessage());  // Log error message
        header('Content-Type: application/json');
        echo json_encode(['error' => 'Database error']);
    }
    exit();
}

// Logic to calculate the schedule with automatic room selection
if (isset($_POST['insert'])) {
    $subject = $_POST['subject'];
    $units = $_POST['units']; 
    $hoursNeeded = $units; // Assuming each unit equals one hour of class time

    $daysOfWeek = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];
    $rooms = ['schedules_cl1', 'schedules_cl2', 'schedules_cl3'];
    $scheduleInserted = false;

    // Loop through each day and room to find available slots
    foreach ($daysOfWeek as $day) {
        foreach ($rooms as $room) {
            $availableSlot = getAvailableSlot($day, $room, $hoursNeeded, $conn);

            // If an available slot is found, insert the schedule
            if ($availableSlot) {
                try {
                    $insertSchedule = $conn->prepare("INSERT INTO $room (subject, start_time, end_time, day, units) VALUES (?, ?, ?, ?, ?)");
                    $insertSchedule->bind_param("sssss", $subject, $availableSlot['start_time'], $availableSlot['end_time'], $day, $units);
                    $insertSchedule->execute();
                    $scheduleInserted = true;
                    break 2; // Exit both loops when a schedule is inserted
                } catch (Exception $e) {
                    error_log($e->getMessage());  // Log error message
                    echo "Error inserting schedule: " . $e->getMessage();
                }
            }
        }
    }

    // Return appropriate message
    if ($scheduleInserted) {
        echo "Schedule inserted successfully.";
    } else {
        echo "No available slot found.";
    }
}

// Helper function to calculate the available time slot
function getAvailableSlot($day, $room, $hoursNeeded, $conn) {
    $startTime = new DateTime('06:00'); // Timetable start time
    $endTime = new DateTime('22:00');   // Timetable end time
    $interval = new DateInterval('PT30M'); // 30-minute time intervals

    // Query to fetch existing schedules for the given day and room
    $query = $conn->prepare("SELECT start_time, end_time FROM $room WHERE day = ? ORDER BY start_time");
    $query->bind_param("s", $day);
    $query->execute();
    $result = $query->get_result();
    
    $existingSchedules = [];
    while ($row = $result->fetch_assoc()) {
        $existingSchedules[] = [
            'start_time' => new DateTime($row['start_time']),
            'end_time' => new DateTime($row['end_time'])
        ];
    }

    // Check for gaps between schedules or from start of the day
    while ($startTime < $endTime) {
        $slotEndTime = clone $startTime;
        $slotEndTime->add(new DateInterval("PT{$hoursNeeded}H"));

        if ($slotEndTime > $endTime) {
            // If the slot end time exceeds the day limit, return false
            return false;
        }

        // Check if the time slot conflicts with existing schedules
        $isConflict = false;
        foreach ($existingSchedules as $schedule) {
            if ($startTime < $schedule['end_time'] && $slotEndTime > $schedule['start_time']) {
                $isConflict = true;
                break;
            }
        }

        if (!$isConflict) {
            // Return available slot details if no conflict is found
            return [
                'start_time' => $startTime->format('H:i'),
                'end_time' => $slotEndTime->format('H:i')
            ];
        }

        // Move to the next available time slot
        $startTime->add($interval);
    }

    return false; // No available slots found
}
?>
