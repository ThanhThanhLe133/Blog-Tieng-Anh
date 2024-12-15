<?php
session_start();
$_SESSION['firstName'] = $_POST['firstName'];
$_SESSION['lastName'] = $_POST['lastName'];
$_SESSION['phone'] = $_POST['phone'];
$_SESSION['email'] = $_POST['email'];
$_SESSION['studySchool'] = $_POST['studySchool'];
$_SESSION['birthYear']= $_POST['birthYear'];
$_SESSION['currentDate']= $_POST['currentDate'];
$conn->close();
?>
