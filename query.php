<?php

// Include the database connection class
include_once 'connect.php';

// Instantiate the Database class and get the connection
$database = new Database();
$conn = $database->connect();

// Check if the connection is successful
if (!$conn) {
    die("Connection failed: " . $database->Message());
}

// Define your SQL query
$sql = "SELECT CONCAT(si.std_fname, ' ', si.std_mname, ' ', si.std_lname, ' ', si.std_age, ' ', si.std_contact_num, ' ', si.std_birth_date) AS `Student Info`, 
                ss1.sub_code, ts.time, ds.day, ra.room 
        FROM sub_schedule ss 
        INNER JOIN time_sched ts ON ss.time_id = ts.time_id 
        INNER JOIN days_sched ds ON ss.day_id = ds.day_id 
        INNER JOIN room_assignment ra ON ss.room_id = ra.room_id 
        INNER JOIN student_subject ss1 ON ss.sub_id = ss1.sub_id 
        INNER JOIN student_info si ON ss.std_id = si.std_id";

// Execute the query using PDO
$stmt = $conn->prepare($sql);
$stmt->execute();

// Check if the query returns any rows
if ($stmt->rowCount() > 0) {
    // Output data in an HTML table
    echo "<table border='1' cellpadding='10' cellspacing='0' style='width: 100%; border-collapse: collapse;'>
            <tr>
                <th>Student Info</th>
                <th>Subject Code</th>
                <th>Time</th>
                <th>Day</th>
                <th>Room</th>
            </tr>";

    // Loop through each row and display it in the table
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        echo "<tr>
                <td>" . htmlspecialchars($row["Student Info"]) . "</td>
                <td>" . htmlspecialchars($row["sub_code"]) . "</td>
                <td>" . htmlspecialchars($row["time"]) . "</td>
                <td>" . htmlspecialchars($row["day"]) . "</td>
                <td>" . htmlspecialchars($row["room"]) . "</td>
              </tr>";
    }

    echo "</table>";
} else {
    // No results found
    echo "<p>No results found.</p>";
}

// Close the connection (optional, as PDO automatically closes when the script ends)
$conn = null;
?>
