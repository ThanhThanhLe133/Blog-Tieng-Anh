<?php
session_start();
$firstName = $_SESSION['firstName'] ?? "";
$lastName = $_SESSION['lastName'] ?? "";
$phone = $_SESSION['phone'] ?? "";
$email = $_SESSION['email'] ?? "";
$studySchool = $_SESSION['studySchool'] ?? "";
$birthYear = $_SESSION['birthYear'] ?? "";

include "../conn.php";
$username = $_POST['username'];
$password = $_POST['password'];

if (empty($firstName) || empty($lastName) || empty($phone) || empty($email) || empty($studySchool) || empty($birthYear)) {
    echo '<p>Bạn chưa điền đầy đủ thông tin vào form. Vui lòng quay lại 
            <a href="../../Web/DangKy/index.html" style="color: red; text-decoration: none; font-weight: bold;">
                trang điền thông tin
            </a> để hoàn tất.</p>';
    exit;
} else {
    $sql = "INSERT INTO users (f_name, l_name, phone_number, email, branch_name, birth_year, username, password)
               VALUES ('$firstName', '$lastName', '$phone', '$email', '$studySchool', '$birthYear', '$username','$password')";
    if ($conn->query($sql) === TRUE) {
        echo "success";
    } else {
        echo "Lỗi khi thêm người dùng";
    }
    session_unset();
    session_destroy();
    $conn->close();
}
?>