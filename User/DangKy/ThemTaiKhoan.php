<?php
// Include file kết nối cơ sở dữ liệu
include 'conn.php';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Lấy thông tin từ form
    $fullname = isset($_POST['fullname']) ? trim($_POST['fullname']) : "";
    $email = isset($_POST['email']) ? trim($_POST['email']) : "";
    $phone_number = isset($_POST['phoneNum']) ? trim($_POST['phoneNum']) : "";
    $password = isset($_POST['password']) ? $_POST['password'] : "";
    $confirm_password = isset($_POST['confirm_password']) ? $_POST['confirm_password'] : "";

    // Tách họ và tên
    $names = explode(" ", $fullname);
    $l_name = array_pop($names);
    $f_name = implode(" ", $names);

    // Kiểm tra mật khẩu và xác nhận mật khẩu
    if ($password !== $confirm_password) {
        echo "<script>alert('Mật khẩu và nhập lại mật khẩu không trùng khớp!');</script>";
        exit;
    }

    // Mã hóa mật khẩu
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Kiểm tra sự tồn tại của email, số điện thoại, username
    $check_query = "SELECT * FROM users WHERE email = ? OR phone_number = ?";
    $stmt = $conn->prepare($check_query);
    $stmt->bind_param("ss", $email, $phone_number);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        echo "<script>alert('Email hoặc số điện thoại đã được sử dụng!');</script>";
        exit;
    }

    // Thêm thông tin vào cơ sở dữ liệu
    $insert_query = "INSERT INTO users (f_name, l_name, username, password, phone_number, email, birth_year, branch_name) 
                      VALUES (?, ?, ?, ?, ?, ?, '', '')";
    $stmt = $conn->prepare($insert_query);
    $username = strtolower($f_name . $l_name); // Tạo username tự động
    $stmt->bind_param("ssssss", $f_name, $l_name, $username, $hashed_password, $phone_number, $email);

    if ($stmt->execute()) {
        echo "<script>alert('Đăng ký thành công!'); window.location.href = 'login.php';</script>";
    } else {
        echo "<script>alert('Có lỗi xảy ra. Vui lòng thử lại sau!');</script>";
    }

    $stmt->close();
}

$conn->close();
?>
