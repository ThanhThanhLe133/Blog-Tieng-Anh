<?php
include "conn.php";
$firstName = $_POST['firstName'];
$lastName = $_POST['lastName'];
$phone = $_POST['phone'];
$email = $_POST['email'];
$studySchool = $_POST['studySchool'];
$birthYear = $_POST['birthYear'];
$strSQL = "INSERT INTO guest (firstName, lastName, phone, email, studySchool, birthYear) 
               VALUES ('$firstName', '$lastName', '$phone', '$email', '$studySchool', '$birthYear')";

if ($conn->query($strSQL) === TRUE) {
    echo "Thông tin của bạn đã được gửi tới chúng tôi!";
} else {
    echo "Không thể gửi thông tin. Vui lòng thử lại.";
}
$conn->close();
?>