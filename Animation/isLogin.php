<?php
session_start();
include "../user/conn.php";

if (isset($_SESSION['admin_logged_in']) && $_SESSION['admin_logged_in'] === true) {
    echo '<button type="button" id="btnLogout" class="btn btn--logout">
    ĐĂNG XUẤT
</button>';

} else {
    echo '<a href="../DangKy/index.html" class="btn btn--register">ĐĂNG KÝ</a>';
}
$conn->close();
?>