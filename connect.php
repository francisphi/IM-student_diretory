<?php

class Database {
    private $servername = "localhost";
    private $dbname = "student_directory";
    private $username = "root";
    private $password = "";
    
    private $dbconn = null;
    private $state = false;
    private $msg;

    public function __construct() {
        try {
            $this->dbconn = new PDO("mysql:host=" . $this->servername . ";dbname=" . $this->dbname, $this->username, $this->password);
            $this->dbconn->exec("set names utf8");
            $this->state = true;
            $this->msg = "Connect Successfully";
        } catch (PDOException $e) {
            $this->state = false;
            $this->msg = "Error! : " . $e->getMessage();
        }
    }

    protected function getConnection() {
        return $this->dbconn;
    }   

    public function connect(){
        return $this->getConnection();
    }

    protected function getState() {
        return $this->state;
    }

    protected function getMessage() {
        return $this->msg;
    }
    public function Message() {
        return $this->getMessage();
    }
}
?>
