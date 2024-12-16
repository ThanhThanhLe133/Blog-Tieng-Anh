<?php
session_start();
include "conn.php";  // Kết nối với cơ sở dữ liệu (nếu cần)

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Kiểm tra xem các giá trị $_POST có tồn tại và không rỗng không
    if (isset($_POST['firstName']) && isset($_POST['lastName']) && isset($_POST['phone']) && isset($_POST['email']) && isset($_POST['studySchool']) && isset($_POST['birthYear'])) {
        
        // Lưu giá trị vào session
        $_SESSION['firstName'] = htmlspecialchars($_POST['firstName']);
        $_SESSION['lastName'] = htmlspecialchars($_POST['lastName']);
        $_SESSION['phone'] = htmlspecialchars($_POST['phone']);
        $_SESSION['email'] = htmlspecialchars($_POST['email']);
        $_SESSION['studySchool'] = htmlspecialchars($_POST['studySchool']);
        $_SESSION['birthYear'] = htmlspecialchars($_POST['birthYear']);

        echo "success";
    } else {
        echo "Vui lòng điền đầy đủ thông tin.";
    }
} else {
    echo "Yêu cầu phương thức POST.";
}

$conn->close(); 
?>
