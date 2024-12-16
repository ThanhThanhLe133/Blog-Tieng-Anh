<?php
session_start();

include "../admin/conn.php";
if (isset($_SESSION['user_logged_in']) && $_SESSION['user_logged_in'] === true) {
    echo '<button type="button" id="btnLogout" class="btn btn--logout">
    ĐĂNG XUẤT
</button>';

} else {
    echo '<a href=http://localhost/BlogTiengAnh/web/dangky/index.html class="btn btn--register">ĐĂNG KÝ</a>';
}
$conn->close();
?>