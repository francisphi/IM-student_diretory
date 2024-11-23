<?php
session_start();
require_once './test.php';

if (!isset($_SESSION['std_id'])) {
    echo json_encode(['status' => 'error', 'message' => 'Unauthorized access']);
    exit();
}

$test = new test();
$std_id = $_SESSION['std_id'];

$studentInfo = $test->get_student_info($std_id);

if ($studentInfo) {
    // Path to the images folder
    $imagePath = './image/' . $studentInfo['std_filename'];

    // Check if the image file exists, otherwise use default
    if (empty($studentInfo['std_filename']) || !file_exists($imagePath)) {
        $studentInfo['std_filename'] = 'default.png';
    }

    echo json_encode(['status' => 'success', 'data' => $studentInfo]);
} else {
    echo json_encode(['status' => 'error', 'message' => 'Student information not found']);
}
