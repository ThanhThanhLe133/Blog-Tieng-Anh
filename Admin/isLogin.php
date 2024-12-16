<?php
session_start();
include "conn.php";

if (isset($_SESSION['admin_logged_in']) && $_SESSION['admin_logged_in'] === true) {
    echo '<button type="button" id="btnLogout" class="btn btn--logout">
    ĐĂNG XUẤT
</button>';

} else {
    echo '<a href="../Login/index.php" class="btn btn--login">ĐĂNG NHẬP</a>';
}
$conn->close();
?>