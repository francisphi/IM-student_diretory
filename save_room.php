<?php
require_once "./test.php";

// Read raw POST data (since it's sent as JSON)
$data = json_decode(file_get_contents('php://input'), true);

// Check if the room name is present in the data
if (isset($data['r_name'])) {
    $room = array(
        "r_id" => 0,  // This can be auto-incremented in your DB
        "r_name" => $data['r_name']
    );

    // Instantiate the test class and call save_room
    $sd = new test();
    $sd->save_room($room);
    
    // Send a success response
    echo json_encode(["status" => "success", "message" => "Room added successfully."]);
} else {
    // Send an error response if room name is missing
    echo json_encode(["status" => "error", "message" => "Room name is required."]);
}
?>
