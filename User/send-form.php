<?php
session_start();
include "conn.php";
$firstName = $_SESSION['firstName'];
$lastName = $_SESSION['lastName'];
$phone =$_SESSION['phone'];
$email = $_SESSION['email'];
$studySchool = $_SESSION['studySchool'];
$birthYear = $_SESSION['birthYear'];
$currentDate = $_SESSION['currentDate'];
$username = $_POST["username"];
$password = $_POST["password"];

$strSQL = "INSERT INTO users (f_name, l_name, phone_number , email, branch_name, birth_year, currentDate,username,password ) 
               VALUES ('$firstName', '$lastName', '$phone', '$email', '$studySchool', '$birthYear', '$username','$password')";
echo "success";
$conn->close();
?>