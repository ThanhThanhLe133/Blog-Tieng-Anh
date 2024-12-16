<?php
session_start();

include "../conn.php";
$username = $_POST["name"];
$password = $_POST["pass"];
$strSQL = "Select * from users where username='$username' && password='$password'";
$result = $conn->query($strSQL);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    if($row['approval_status'] == 0)
    {
        echo "Tài khoản chưa được xác thực. Vui lòng kiểm tra email hoặc thử lại sau!";
        exit;
    }
    $_SESSION['user_logged_in'] = true;
    $_SESSION['username'] = $username;
    $_SESSION['user_id'] = $row['user_id'];
    echo "Chúc mừng bạn đã đăng nhập thành công";
} else {
    echo "Tên đăng nhập hoặc mật khẩu không đúng. Vui lòng đăng nhập lại!!!";
}

$conn->close();
?>