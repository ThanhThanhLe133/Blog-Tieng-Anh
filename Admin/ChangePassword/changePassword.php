<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "";
$DBName = "BLOGTIENGANH";

$conn = mysqli_connect($servername, $username, $password, $DBName)
    or die("<p>Không thể connect</p>" . "<p>Error code: " . mysqli_connect_error() . ": " . mysqli_connect_error() . "</p>");

$conn->set_charset("utf8");

if (isset($_POST["newPassword"], $_SESSION['email'])) {
    $newPassword = $_POST["newPassword"];
    $email = $_SESSION["email"];

    $stmt = $conn->prepare("SELECT password FROM admin WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->bind_result($currentPassword);
    $stmt->fetch();
    $stmt->close();

    if ($currentPassword === $newPassword) {
        echo "Mật khẩu mới không được trùng với mật khẩu hiện tại.";
    } else {
        $stmt = $conn->prepare("UPDATE admin SET password = ? WHERE email = ?");
        $stmt->bind_param("ss", $newPassword, $email);
        if ($stmt->execute()) {
            $_SESSION = [];
            session_destroy();
            echo "Mật khẩu đã được thay đổi thành công!";
        } else {
            echo "Không thể cập nhật mật khẩu. Vui lòng thử lại.";
        }
        $stmt->close();
    }
}
$conn->close();
?>