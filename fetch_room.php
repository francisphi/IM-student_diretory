<?php
require_once './connect.php';

try {
    // Create a new Database object and get the connection
    $db = new Database();
    $pdo = $db->Connect();

    // Get the search term from the query string, if available
    $searchTerm = isset($_GET['search']) ? $_GET['search'] : '';

    // Prepare the SQL query to search for rooms based on the search term
    $sql = "SELECT * FROM room_assignment WHERE room_id LIKE :searchTerm OR room LIKE :searchTerm ";
    $stmt = $pdo->prepare($sql);

    // Add wildcards for the LIKE search
    $searchWildcard = "%" . $searchTerm . "%";

    // Bind the parameter
    $stmt->bindParam(':searchTerm', $searchWildcard, PDO::PARAM_STR);

    // Execute the query
    $stmt->execute();

    // Start building the HTML output for the table
    if ($stmt->rowCount() > 0) {
        // There are rows to display
        $output = '<table class="table table-bordered transparent-table" style="text-align:center; width:100%;">';
        $output .= '<thead>
                        <tr>
                            <th>Room ID</th>
                            <th>Room Name</th>
                        </tr>
                    </thead>';
        $output .= '<tbody>';

        // Loop through the rows and add them to the table
        while ($room = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $output .= '<tr>';
            $output .= '<td>' . htmlspecialchars($room['room_id'], ENT_QUOTES, 'UTF-8') . '</td>';
            $output .= '<td>' . htmlspecialchars($room['room'], ENT_QUOTES, 'UTF-8') . '</td>';
            $output .= '</tr>';
        }

        $output .= '</tbody></table>';
    } else {
        // No results found
        $output = '<div class="alert alert-warning">No rooms found matching your search.</div>';
    }

    // Return the generated HTML
    echo $output;
} catch (PDOException $e) {
    // Handle any errors
    echo "Error: " . $e->getMessage();
}
?>
