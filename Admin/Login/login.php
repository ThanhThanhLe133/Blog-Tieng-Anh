<?php
session_start();

include "../conn.php";
$username = $_POST["name"];
$password = $_POST["pass"];
$strSQL = "Select * from admin where username='$username' && password='$password'";
$result = $conn->query($strSQL);

if ($result->num_rows > 0) {
    $_SESSION['user_logged_in'] = true;
    $_SESSION['user_name'] = $username;
    echo "Chúc mừng bạn đã đăng nhập thành công";
} else {
    echo "Tên đăng nhập hoặc mật khẩu không đúng. Vui lòng đăng nhập lại!!!";
}

$conn->close();
?>