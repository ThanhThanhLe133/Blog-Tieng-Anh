<?php
// verify_code.php
session_start();  // Khởi tạo session

if (isset($_POST['verification_code'])) {
    $input_code = $_POST['verification_code'];
    
    if (isset($_SESSION['verification_code'])) {
        if (time() - $_SESSION['verification_code_time'] > 30) {
            echo "Mã xác thực đã hết hạn. Vui lòng yêu cầu mã mới.";
        } elseif ($_SESSION['verification_code'] == $input_code) {
            echo "Mã xác thực đúng!";
        } else {
            echo "Mã xác thực không chính xác. Vui lòng thử lại.";
        }
    } else {
        echo "Không tìm thấy mã xác thực. Vui lòng yêu cầu mã mới.";
    }
}
?>