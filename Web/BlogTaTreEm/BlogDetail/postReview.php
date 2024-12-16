<?php
include "conn.php";
session_start();
$comment = $_POST['comment'];
$blog_id = $_POST['blog_id'];
$username=$_SESSION['username'];
$strSQL = "INSERT INTO comment (firstName, lastName, phone, email, studySchool, birthYear, currentDate) 
               VALUES ('$firstName', '$lastName', '$phone', '$email', '$studySchool', '$birthYear', '$currentDate')";

if ($conn->query($strSQL) === TRUE) {
    echo "Thông tin của bạn đã được gửi tới chúng tôi!";
} else {
    echo "Không thể gửi thông tin. Vui lòng thử lại.";
}
$conn->close();

?>