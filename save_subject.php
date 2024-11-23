<?php
require_once "./test.php";

// Read the incoming JSON request
$inputData = json_decode(file_get_contents('php://input'), true);

// Check if the required fields are provided
if (isset($inputData['s_code']) && isset($inputData['s_name'])) {
    $sub = array(
        "s_id" => 0, // You can modify this based on your requirements
        "s_code" => $inputData['s_code'],
        "s_name" => $inputData['s_name']
    );

    // Instantiate the test class and save the subject
    $sd = new test();
    $sd->save_subject($sub);
} else {
    // If required data is missing, respond with an error message
    echo json_encode(['error' => 'Missing required fields']);
}
?>
