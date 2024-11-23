<?php
require_once './connect.php';

try {
    $db = new Database();
    $pdo = $db->Connect(); // Get the connection

    // Get the search term from the query string, if available
    $searchTerm = isset($_GET['search']) ? $_GET['search'] : '';

    // Prepare the SQL query to search for subjects based on the search term
    $sql = "SELECT * FROM student_subject WHERE sub_id LIKE :searchTerm OR sub_code LIKE :searchTerm OR sub_name LIKE :searchTerm";
    $stmt = $pdo->prepare($sql);
    $searchWildcard = "%" . $searchTerm . "%";
    $stmt->bindParam(':searchTerm', $searchWildcard, PDO::PARAM_STR);
    $stmt->execute();

    // Start building the HTML output
    $output = '<table class="table table-bordered transparent-table" style="text-align:center; width:100%;">';
    $output .= '<thead>
                    <tr>
                        <th>Subject ID</th>
                        <th>Subject Code</th>
                        <th>Subject Name</th>
                    </tr>
                </thead>';
    $output .= '<tbody>';

    // Loop through the subjects and build the table rows
    while ($subject = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $output .= '<tr>';
        $output .= '<td>' . htmlspecialchars($subject['sub_id']) . '</td>';
        $output .= '<td>' . htmlspecialchars($subject['sub_code']) . '</td>';
        $output .= '<td>' . htmlspecialchars($subject['sub_name']) . '</td>';
        $output .= '</tr>';
    }

    $output .= '</tbody></table>';
    echo $output; // Return the HTML
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>
