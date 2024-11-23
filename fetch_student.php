<?php
require_once './connect.php';

try {
    $db = new Database();
    $pdo = $db->Connect(); // Get the connection

    // Get the search term from the query string, if available
    $searchTerm = isset($_GET['search']) ? $_GET['search'] : '';

    // Prepare the SQL query to search for students based on the search term
    $sql = "SELECT * FROM student_info WHERE std_fname LIKE :searchTerm 
            OR std_mname LIKE :searchTerm 
            OR std_lname LIKE :searchTerm 
            OR std_id LIKE :searchTerm 
            OR std_contact_num LIKE :searchTerm";
    $stmt = $pdo->prepare($sql);
    $searchWildcard = "%" . $searchTerm . "%";
    $stmt->bindParam(':searchTerm', $searchWildcard, PDO::PARAM_STR);
    $stmt->execute();

    // Start building the HTML output
    $output = '<table class="table table-bordered transparent-table" style="text-align:center; width:100%;">';
    $output .= '<thead>
                    <tr>
                        <th>Student ID</th>
                        <th>Student Name</th>
                        <th>Age</th>
                        <th>Contact #</th>
                        <th>Birth Date</th>
                    </tr>
                </thead>';
    $output .= '<tbody>';

    // Loop through the students and build the table rows
    while ($student = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $output .= '<tr>';
        $output .= '<td>' . htmlspecialchars($student['std_id']) . '</td>';
        $output .= '<td>' . htmlspecialchars($student['std_fname'] . ' ' . $student['std_mname'] . ' ' . $student['std_lname']) . '</td>';
        $output .= '<td>' . htmlspecialchars($student['std_age']) . '</td>';
        $output .= '<td>' . htmlspecialchars($student['std_contact_num']) . '</td>';
        $output .= '<td>' . htmlspecialchars($student['std_birth_date']) . '</td>';
        $output .= '</tr>';
    }

    $output .= '</tbody></table>';
    echo $output; // Return the HTML
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>
