<?php
require_once "./connect.php";

class test extends Database {
    public function __construct() {
        parent::__construct();
    }

    // Method to save student
    public function save_student($stud) {
        $sql = "CALL save_student(:p_id, :p_fname, :p_lname, :p_mname, :p_age, :p_contact_num, :p_birth_date, :p_filename)";
        $db = parent::getConnection();
        $stmt = $db->prepare($sql);
        $stmt->bindParam(":p_id", $stud['p_id']);
        $stmt->bindParam(":p_fname", $stud['p_fname']);
        $stmt->bindParam(":p_lname", $stud['p_lname']);
        $stmt->bindParam(":p_mname", $stud['p_mname']);
        $stmt->bindParam(":p_age", $stud['p_age']);
        $stmt->bindParam(":p_contact_num", $stud['p_contact_num']);
        $stmt->bindParam(":p_birth_date", $stud['p_birth_date']);
        $stmt->bindParam(":p_filename", $stud['p_filename']);
        $stmt->execute();
        echo "Student Saved Successfully";
    }

    // Method to save subject
    public function save_subject($sub) {
        $sql = "CALL save_subject(:s_id, :s_code, :s_name)";
        $db = parent::getConnection();
        $stmt = $db->prepare($sql);
        $stmt->bindParam(":s_id", $sub['s_id']);
        $stmt->bindParam(":s_code", $sub['s_code']);
        $stmt->bindParam(":s_name", $sub['s_name']);
        $stmt->execute();
        echo "Subject Saved";
    }

    // Method to save room
    public function save_room($room) {
        $sql = "CALL saves_room(:r_id, :r_name)";
        $db = parent::getConnection();
        $stmt = $db->prepare($sql);
        $stmt->bindParam(":r_id", $room['r_id']);
        $stmt->bindParam(":r_name", $room['r_name']);
        $stmt->execute();
        echo "Room Saved";
    }

    // Method to check login
    public function check_login($std_id, $password) {
        $sql = "SELECT * FROM student_info WHERE std_id = :std_id";
        $db = parent::getConnection();
        $stmt = $db->prepare($sql);
        $stmt->bindParam(":std_id", $std_id);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user['password'])) {
            return [
                'status' => 'success',
                'role' => $user['role'] ?? 'student',
                'message' => 'Login Successfully!'
            ];
        } else {
            return ['status' => 'error', 'message' => 'Invalid credentials'];
        }
    }

    public function get_student_info($std_id) {
        $query = "
            SELECT DISTINCT
                si.std_id,
                CONCAT(si.std_lname, ', ', si.std_fname, ' ', si.std_mname) AS Student_Name, 
                si.std_age, 
                si.std_contact_num, 
                si.std_birth_date,
                si.std_filename
            FROM 
                student_info si
            WHERE si.std_id = :std_id
        ";
        
        $stmt = $this->Connect()->prepare($query);
        $stmt->bindParam(':std_id', $std_id, PDO::PARAM_INT);
        $stmt->execute();
        $studentInfo = $stmt->fetch(PDO::FETCH_ASSOC);
        
        $studentInfo['Student_Name'];
        
        // Fetch subject details
        $querySubjects = "
            SELECT DISTINCT
                ss1.sub_code AS Subject_Code, 
                ts.time AS Time, 
                GROUP_CONCAT(DISTINCT 
                    CASE 
                        WHEN ds.day = 'Tuesday' THEN 'Tuesday'
                        WHEN ds.day = 'Thursday' THEN 'Thursday'
                        ELSE ds.day 
                    END 
                    ORDER BY FIELD(ds.day, 'Monday', 'Wednesday', 'Friday', 'Tuesday', 'Thursday') 
                    SEPARATOR '-') AS Day_Schedule,
                ra.room AS Room
            FROM 
                student_load sl
            LEFT JOIN sub_schedule ss ON ss.sched_id = sl.sched_id
            LEFT JOIN time_sched ts ON ss.time_id = ts.time_id
            LEFT JOIN days_sched ds ON ss.day_id = ds.day_id
            LEFT JOIN room_assignment ra ON ss.room_id = ra.room_id
            LEFT JOIN student_subject ss1 ON ss.sub_id = ss1.sub_id
            WHERE sl.std_id = :std_id
            GROUP BY ss1.sub_code, ts.time, ra.room
        ";
        
        $stmtSubjects = $this->Connect()->prepare($querySubjects);
        $stmtSubjects->bindParam(':std_id', $std_id, PDO::PARAM_INT);
        $stmtSubjects->execute();
        $subjects = $stmtSubjects->fetchAll(PDO::FETCH_ASSOC);
        
        // Combine student info with subjects
        $studentInfo['Subjects'] = $subjects;
        
        return $studentInfo;
    }
    
    
    
    
}
