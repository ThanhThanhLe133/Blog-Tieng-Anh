<?php
// Đảm bảo đường dẫn tới PHPMailer đúng
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
require '../PHPMailer/src/SMTP.php';
require '../PHPMailer/src/PHPMailer.php';
require '../PHPMailer/src/Exception.php';
session_start();

// Kết nối cơ sở dữ liệu
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "BLOGTIENGANH";

$_SESSION['verification_code'];
$_SESSION['verification_code_time'];
// Hàm kết nối cơ sở dữ liệu
$conn = mysqli_connect($servername, $username, $password, $dbname);
if (!$conn) {
    die("<p>Không thể kết nối</p>" . "<p>Lỗi: " . mysqli_connect_error() . "</p>");
}
mysqli_set_charset($conn, "utf8");

if (isset($_POST['email'])) {
    $email = $_POST['email'];
    $stmt = $conn->prepare("SELECT * FROM admin WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows <= 0) {
        echo "Email không tồn tại trong hệ thống.";
        return;
    }
    if (isset($_SESSION['verification_code_time']) && time() - $_SESSION['verification_code_time'] > 30) {
        unset($_SESSION['verification_code']);
        unset($_SESSION['verification_code_time']);
    }
    $_SESSION['email'] = $email;
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
        $mail->Body = "Your Verification Code is: <b>$verification_code</b>";

        $mail->send();
        echo "Mã xác thực đã được gửi đến email của bạn.";
        return;
    } catch (Exception $e) {
        echo "Lỗi khi gửi email: {$mail->ErrorInfo}";
    }
}


$conn->close();
?>