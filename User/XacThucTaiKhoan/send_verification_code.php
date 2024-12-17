<?php
// Đảm bảo đường dẫn tới PHPMailer đúng
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
require '../../admin/PHPMailer/src/SMTP.php';
require '../../admin/PHPMailer/src/PHPMailer.php';
require '../../admin/PHPMailer/src/Exception.php';
session_start();

include "../conn.php";

$_SESSION['verification_code'];
$_SESSION['verification_code_time'];

if (isset($_POST['email'])) {
    $email = $_POST['email'];
    $sql ="SELECT * FROM admin WHERE email =  '$email'";
    $result = $conn->query($sql);

    if ($result->num_rows <= 0) {
        echo "Email không tồn tại trong hệ thống.";
        return;
    }

    if (isset($_SESSION['verification_code_time']) && time() - $_SESSION['verification_code_time'] > 30) {
        unset($_SESSION['verification_code']);
        unset($_SESSION['verification_code_time']);
    }
    $_SESSION['user_id'] = $row['usernanme'];
    $verification_code = rand(100000, 999999); // Tạo mã xác thực
    $_SESSION['verification_code'] = $verification_code; // Lưu vào session
    $_SESSION['verification_code_time'] = time();

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
        $mail->Subject = 'Verification Code';
        $mail->Body = "Your Verification Code at Kids & Us is: <b>$verification_code</b>";

        $mail->send();
        echo "Mã xác thực đã được gửi đến email của bạn.";
        return;
    } catch (Exception $e) {
        echo "Lỗi khi gửi email: {$mail->ErrorInfo}";
    }
}
$conn->close();
?>