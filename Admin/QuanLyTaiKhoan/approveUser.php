<?php
// Đảm bảo đường dẫn tới PHPMailer đúng
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
require '../PHPMailer/src/SMTP.php';
require '../PHPMailer/src/PHPMailer.php';
require '../PHPMailer/src/Exception.php';
session_start();

include "../conn.php";
$users_id = $_POST['users_id'];
$sql = "SELECT * FROM users WHERE users_id =  '$users_id'";
$result = $conn->query($sql);

if ($result->num_rows <= 0) {
    echo "Email không tồn tại trong hệ thống.";
    return;
}
$row = $result->fetch_assoc();
$email = $row['email'];
$mail = new PHPMailer(true);

try {
    $mail->isSMTP();
    $mail->Host = 'smtp.zoho.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'english4fun@zohomail.com';
    $mail->Password = '@4FFun@@';
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port = 587;

    $mail->setFrom('english4fun@zohomail.com', 'Kids And Us');
    $mail->addAddress($email);

    $mail->isHTML(true);
    $mail->Subject = 'Xác nhận đăng ký tài khoản website Kid & Us';
    $mail->Body = "Tài khoản của bạn đã được phê duyệt. Vui lòng truy cập <a href='http://localhost/BlogTiengAnh/User/Login/index.php'>website của chúng tôi</a> để đăng nhập.";

    $mail->send();

    $strSql = "UPDATE users SET approval_status = 1 WHERE users_id =  '$users_id'";
    $resultUpdate = $conn->query($strSql);
    if ($resultUpdate === TRUE) {
        echo "success";
        return;
    } else {
        echo "Không thể cập nhật thông tin. Vui lòng thử lại.";
    }
} catch (Exception $e) {
    echo "Lỗi khi gửi email: {$mail->ErrorInfo}";
}

$conn->close();
?>