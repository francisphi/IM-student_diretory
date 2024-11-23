<?php
session_start();
require_once './test.php';

// Check if the user is logged in
if (!isset($_SESSION['std_id'])) {
    echo json_encode(['status' => 'error', 'message' => 'Unauthorized access']);
    exit();
}

$std_id = $_SESSION['std_id'];
$std_name = $_POST['Student_Name'] ?? null;
$std_age = $_POST['std_age'] ?? null;
$std_contact = $_POST['std_contact_num'] ?? null;
$std_birth_date = $_POST['std_birth_date'] ?? null;

// Validate required fields
if (!$std_name || !$std_age || !$std_contact || !$std_birth_date) {
    echo json_encode(['status' => 'error', 'message' => 'All fields are required.']);
    exit();
}

// Handle file upload if a new profile picture is provided
$targetDir = "image/"; // Directory to store uploaded images
$newFilename = null;

if (isset($_FILES['profile-picture']) && $_FILES['profile-picture']['error'] === UPLOAD_ERR_OK) {
    $fileTmpPath = $_FILES['profile-picture']['tmp_name'];
    $fileName = basename($_FILES['profile-picture']['name']);
    $fileExtension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
    $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif'];

    // Validate file type
    if (!in_array($fileExtension, $allowedExtensions)) {
        echo json_encode(['status' => 'error', 'message' => 'Invalid file type. Only JPG, PNG, and GIF are allowed.']);
        exit();
    }

    // Generate a unique filename to avoid conflicts
    $uniqueFileName = uniqid() . "_" . $fileName;
    $targetFile = $targetDir . $uniqueFileName;

    // Ensure the target directory exists and is writable
    if (!is_dir($targetDir)) {
        mkdir($targetDir, 0777, true); // Create the directory if it doesn't exist
    }
    if (!is_writable($targetDir)) {
        echo json_encode(['status' => 'error', 'message' => 'Upload directory is not writable.']);
        exit();
    }

    // Move the uploaded file to the target directory
    if (!move_uploaded_file($fileTmpPath, $targetFile)) {
        echo json_encode(['status' => 'error', 'message' => 'Failed to upload the profile picture.']);
        exit();
    }

    $newFilename = $uniqueFileName;
}

try {
    $test = new test();
    $sql = "
        UPDATE student_info
        SET Student_Name = :Student_Name, 
            std_age = :std_age,
            std_contact_num = :std_contact_num,
            std_birth_date = :std_birth_date
    ";

    // Include `std_filename` only if a new file was uploaded
    if ($newFilename) {
        $sql .= ", std_filename = :std_filename ";
    }

    $sql .= "WHERE std_id = :std_id";

    $stmt = $test->Connect()->prepare($sql);
    $stmt->bindParam(':Student_Name', $std_name);
    $stmt->bindParam(':std_age', $std_age);
    $stmt->bindParam(':std_contact_num', $std_contact);
    $stmt->bindParam(':std_birth_date', $std_birth_date);
    $stmt->bindParam(':std_id', $std_id);

    if ($newFilename) {
        $stmt->bindParam(':std_filename', $newFilename);
    }

    if ($stmt->execute()) {
        echo json_encode([
            'status' => 'success',
            'message' => 'Profile updated successfully',
            'new_filename' => $newFilename ?? null
        ]);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Failed to update profile.']);
    }
} catch (Exception $e) {
    echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
}
