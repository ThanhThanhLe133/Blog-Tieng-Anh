<?php
session_start();

include "conn.php";
if (isset($_SESSION['user_logged_in']) && $_SESSION['user_logged_in'] === true) {
    echo '<button type="button" id="btnLogout" class="btn btn--logout">
    ĐĂNG XUẤT
</button>';

} else {
    echo '<a href=../dangky/index.html class="btn btn--register">ĐĂNG KÝ</a>';
}
$conn->close();
?>