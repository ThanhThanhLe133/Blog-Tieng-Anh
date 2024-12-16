<?php
session_start();
include "conn.php"; 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['firstName']) && isset($_POST['lastName']) && isset($_POST['phone']) && isset($_POST['email']) && isset($_POST['studySchool']) && isset($_POST['birthYear'])) {
        
        $_SESSION['firstName'] =$_POST['firstName'];
        $_SESSION['lastName'] = $_POST['lastName'];
        $_SESSION['phone'] = $_POST['phone'];
        $_SESSION['email'] = $_POST['email'];
        $_SESSION['studySchool'] = $_POST['studySchool'];
        $_SESSION['birthYear'] = $_POST['birthYear'];

        echo "success";
    } else {
        echo "Vui lòng điền đầy đủ thông tin.";
    }
} else {
    echo "Yêu cầu phương thức POST.";
}

$conn->close(); 
?>
