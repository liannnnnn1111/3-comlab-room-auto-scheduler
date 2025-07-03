<!DOCTYPE html>
<html>
<head>
    <title>Assign Schedule</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <style>
        /* Simple styling to ensure visibility */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }
        #assign {
            margin: 20px;
            padding: 20px;
            max-width: 600px; /* Set a max-width to make it look better on larger screens */
            width: 100%;
            background-color: white; /* Optional: White background for contrast */
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); /* Optional: Add a shadow for better visibility */
            border-radius: 8px; /* Optional: Rounded corners */
        }
        input, button {
            margin: 10px 0;
            padding: 10px;
            font-size: 16px;
            box-sizing: border-box;
        }
        input[type="text"], input[type="number"] {
            width: 100%;
            box-sizing: border-box; /* Ensure padding is included in width */
        }
        button {
            background-color: #28a745; /* Green background */
            color: white;
            border: none;
            cursor: pointer;
            width: 100%; /* Make button full width */
            padding: 15px; /* Increase padding for a better look */
        }
        button:hover {
            background-color: #218838; /* Darker green on hover */
        }
    </style>
</head>
<body>
    <div class="data" id="assign">
        <table style="width: 100%; margin-left: 150px;">
            <tbody>
                <tr>
                    <td>
                        <input type="text" name="subject" id="subject" placeholder="Subject" required>
                    </td>
                </tr>
                <tr>
                    <td>
                        <input type="number" name="units" id="units" placeholder="Units" required>
                    </td>
                </tr>
                <tr>
                    <td>
                        <button onclick="create()">Insert</button>
                    </td>
                </tr>
            </tbody>
        </table>

        <script type="text/javascript">
            function create() { 
                var subject = $('#subject').val(); 
                var units = $('#units').val();
                
                $.ajax({
                    type: 'POST',
                    url: 'admin/controller.php',
                    data: {
                        insert: true,
                        subject: subject, 
                        units: units
                    },
                    dataType: 'html',
                    success: function(response) {
                        alert(response);
                        retrieve(); // Refresh the schedule view
                    },
                    error: function(xhr, status, error) {
                        console.error("Error: " + error);
                    }
                });
            }
        </script>
    </div>
</body>
</html>
