<?php
require_once "test.php";

// Read the raw POST data
$inputData = json_decode(file_get_contents('php://input'), true);

if (isset($inputData['std_id']) && isset($inputData['password'])) {
    $std_id = trim($inputData['std_id']);
    $password = trim($inputData['password']);

    try {
        $test = new test();
        $db = $test->Connect();

        // Admin login check
        $admin_sql = "SELECT * FROM admin_login WHERE ad_username = :std_id AND ad_password = :password";
        $admin_stmt = $db->prepare($admin_sql);
        $admin_stmt->bindParam(':std_id', $std_id);
        $admin_stmt->bindParam(':password', $password);
        $admin_stmt->execute();

        $admin = $admin_stmt->fetch(PDO::FETCH_ASSOC);
        if ($admin) {
            session_start();
            $_SESSION['admin_id'] = $admin['ad_id'];
            echo json_encode(['status' => 'success', 'role' => 'admin']);
            exit();
        }

        // Student login check
        $student_sql = "SELECT * FROM student_info WHERE std_id = :std_id AND std_lname = :password";
        $student_stmt = $db->prepare($student_sql);
        $student_stmt->bindParam(':std_id', $std_id);
        $student_stmt->bindParam(':password', $password);
        $student_stmt->execute();

        $student = $student_stmt->fetch(PDO::FETCH_ASSOC);
        if ($student) {
            session_start();
            $_SESSION['std_id'] = $student['std_id'];
            echo json_encode(['status' => 'success', 'role' => 'student']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Invalid student ID or password']);
        }
    } catch (PDOException $e) {
        echo json_encode(['status' => 'error', 'message' => 'Database error: ' . $e->getMessage()]);
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'Missing student ID or password']);
}
?>
