<?php 
 require_once "./test.php";

 $stud = array(
    "p_id"=>0,
    "p_fname"=>isset($_POST['fname']) ? $_POST['fname']:'',
    "p_lname"=>isset($_POST['lname']) ? $_POST['lname']:'',
    "p_mname"=>isset($_POST['mname']) ? $_POST['mname']:'',
    "p_age"=>isset($_POST['age']) ? $_POST['age']:'',
    "p_contact_num"=>isset($_POST['contact_num']) ? $_POST['contact_num']:'',
    "p_birth_date"=>isset($_POST['birth_date']) ? $_POST['birth_date']:'', 
    "p_filename"=>isset($_POST['filename']) ? $_POST['filename']:'' 
 );

 $sd=new test();
 $sd->save_student($stud);
?>

