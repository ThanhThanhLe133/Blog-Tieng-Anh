<?php
session_start();
$servername = "localhost";
$username = "root";
$password = "";
$DBName = "BLOGTIENGANH";

$conn = mysqli_connect($servername, $username, $password, $DBName)
    or die("<p>Không thể connect</p>" . "<p>Error code: " . mysqli_connect_error() . ": " . mysqli_connect_error() . "</p>");

mysqli_set_charset($conn, "utf8");

if (isset($_SESSION['user_logged_in']) && $_SESSION['user_logged_in'] === true) {
    echo '<button type="button" id="btnLogout" class="btn btn--logout" style="display: flex; width: 130px; gap: 0; justify-content: space-around; align-items: center;">
    ĐĂNG XUẤT 
    <img style="height: 20px" id="logout" src="../../images/logout.png">
</button>';

} else {
    echo '<a href="../Login/index.html" class="btn btn--login">ĐĂNG NHẬP</a>';
}
?>