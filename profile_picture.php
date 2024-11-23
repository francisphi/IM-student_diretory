<?php
session_start();

// Ensure the user is logged in
if (!isset($_SESSION['std_id'])) {
    echo json_encode(['status' => 'error', 'message' => 'Unauthorized']);
    exit();
}

// Check if the file was uploaded
if (!isset($_FILES['profile-picture']) || $_FILES['profile-picture']['error'] !== UPLOAD_ERR_OK) {
    echo json_encode(['status' => 'error', 'message' => 'No file uploaded or there was an error during the upload.']);
    exit();
}

$allowedMimeTypes = ['image/jpeg', 'image/png', 'image/gif'];
$maxFileSize = 2 * 1024 * 1024; // 2MB

// Validate file type
if (!in_array($_FILES['profile-picture']['type'], $allowedMimeTypes)) {
    echo json_encode(['status' => 'error', 'message' => 'Only JPEG, PNG, and GIF files are allowed.']);
    exit();
}

// Validate file size
if ($_FILES['profile-picture']['size'] > $maxFileSize) {
    echo json_encode(['status' => 'error', 'message' => 'File size exceeds the 2MB limit.']);
    exit();
}

$targetDir = "student-directory-system(IM-2)/image/"; // Directory where the file will be stored
$fileName = preg_replace('/[^a-zA-Z0-9\._-]/', '_', basename($_FILES['profile-picture']['name']));
$uniqueFileName = uniqid() . "_" . $fileName;
$targetFile = $targetDir . $uniqueFileName;

// Ensure the directory exists and is writable
if (!is_dir($targetDir) || !is_writable($targetDir)) {
    echo json_encode(['status' => 'error', 'message' => 'Upload directory is not writable. Please check permissions.']);
    exit();
}

// Move the uploaded file to the target directory
if (move_uploaded_file($_FILES['profile-picture']['tmp_name'], $targetFile)) {
    require_once "./test.php"; // Database connection

    $test = new test();
    $std_id = $_SESSION['std_id'];

    // Store the relative file path in the database
    $sql = "UPDATE student_info SET std_filename = :file WHERE std_id = :std_id";
    $stmt = $test->Connect()->prepare($sql);
    $stmt->bindParam(':file', $uniqueFileName);
    $stmt->bindParam(':std_id', $std_id);

    if ($stmt->execute()) {
        echo json_encode(['status' => 'success', 'new_filename' => $uniqueFileName]);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Failed to update the database.']);
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'Failed to move uploaded file. Check the target directory for write permissions.']);
}
?>
