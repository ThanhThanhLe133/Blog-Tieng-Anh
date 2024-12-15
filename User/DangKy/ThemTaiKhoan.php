<?php
// Kết nối cơ sở dữ liệu
include 'conn.php';

$message = "";
$redirect = ""; // Chỉ định biến redirect để kiểm soát chuyển hướng

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Lấy thông tin từ form
    $username = isset($_POST['username']) ? trim($_POST['username']) : "";
    $email = isset($_POST['email']) ? filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL) : "";
    $phone_number = isset($_POST['phoneNum']) ? htmlspecialchars(trim($_POST['phoneNum'])) : "";
    $password = isset($_POST['password']) ? $_POST['password'] : "";
    $confirm_password = isset($_POST['confirm_password']) ? $_POST['confirm_password'] : "";

    // Kiểm tra mật khẩu và xác nhận mật khẩu
    if ($password !== $confirm_password) {
        $message = "Mật khẩu và nhập lại mật khẩu không trùng khớp!";
    } else {
        // Kiểm tra sự tồn tại của email hoặc số điện thoại
        $check_query = "SELECT * FROM users WHERE email = ? OR phone_number = ?";
        $stmt = $conn->prepare($check_query);
        $stmt->bind_param("ss", $email, $phone_number);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $message = "Email hoặc số điện thoại đã được sử dụng!";
        } else {
            // Thêm thông tin vào cơ sở dữ liệu
            $insert_query = "INSERT INTO users (username, password, phone_number, email) VALUES (?, ?, ?, ?)";
            $stmt = $conn->prepare($insert_query);
            $stmt->bind_param("ssss", $username, $password, $phone_number, $email);

            if ($stmt->execute()) {
                $message = "Đăng ký thành công!";
                $redirect = "../Login/index.php"; // Chuyển hướng chỉ khi thành công
            } else {
                $message = "Có lỗi xảy ra. Vui lòng thử lại sau!";
            }
        }
        $stmt->close();
    }
}

$conn->close();
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thông báo</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <style>
        .toast {
            position: fixed;
            top: 20px;
            right: 20px;
            z-index: 1055;
        }
    </style>
</head>
<body>

    <!-- Thông báo -->
    <?php if (!empty($message)): ?>
        <div class="toast align-items-center text-bg-primary border-0" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="d-flex">
                <div class="toast-body">
                    <?= htmlspecialchars($message) ?>
                </div>
                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
        </div>
        <script>
            const toastEl = document.querySelector('.toast');
            const toast = new bootstrap.Toast(toastEl);
            toast.show();

            // Tự động chuyển hướng sau 3 giây nếu thành công
            <?php if (!empty($redirect)): ?>
                setTimeout(() => {
                    window.location.href = "<?= htmlspecialchars($redirect) ?>";
                }, 3000);
            <?php endif; ?>
        </script>
    <?php endif; ?>
</body>
</html>
