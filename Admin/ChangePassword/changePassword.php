<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    echo "<script>
        alert('Vui lòng đăng nhập!');
        window.location.href = '../ login/index.php';
    </script>";
    exit;
}
include "../conn.php";

$user_id = $_SESSION['user_id'];

$newPassword = $_POST["newPassword"];
$strSQL = "SELECT * FROM admin WHERE username='$user_id'";
$result = $conn->query($strSQL);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $currentPassword = $row['password'];
} else {
    echo "Lỗi: Không tìm thấy tài khoản. Vui lòng kiểm tra lại!";
    return;
}

if ($currentPassword === $newPassword) {
    echo "Mật khẩu mới không được trùng với mật khẩu hiện tại.";
    return;
}
$sql = "UPDATE admin SET password = '$newPassword' WHERE username='$user_id'";

if ($conn->query($sql) === TRUE) {
    $_SESSION = [];
    session_destroy();
    echo "Mật khẩu đã được thay đổi thành công!";
} else {
    echo "Không thể cập nhật mật khẩu. Vui lòng thử lại.";
}

$conn->close();
?>