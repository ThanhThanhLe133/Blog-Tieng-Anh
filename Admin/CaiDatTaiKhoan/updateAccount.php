<?php
session_start();

include "../conn.php";
$user_name = $_SESSION['user_name'];
$firstname = $_POST["firstname"];
$lastname = $_POST["lastname"];
$username = $_POST["username"];
$email = $_POST["email"];
if (isset($_POST["firstname"]) && isset($_POST["lastname"]) && isset($_POST["username"]) && isset($_POST["email"])) {
    $strSQL = "UPDATE admin SET first_name='$firstname',last_name='$lastname', username='$username', email='$email' where username = '$user_name'";

    $result = $conn->query($strSQL);

    if ($result ===TRUE) {
        $_SESSION['user_name'] = $_POST["username"];
        echo "Cập nhật thông tin thành công!";
    } else {
        echo "Không thể cập nhật thông tin. Vui lòng thử lại.";
    }
}

$conn->close();
?>