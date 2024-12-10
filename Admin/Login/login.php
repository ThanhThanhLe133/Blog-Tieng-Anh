<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "";
$DBName = "BLOGTIENGANH";

$conn = mysqli_connect($servername, $username, $password, $DBName)
    or die("<p>Không thể connect</p>" . "<p>Error code: " . mysqli_connect_error() . ": " . mysqli_connect_error() . "</p>");

mysqli_set_charset($conn, "utf8");

if (isset($_POST["name"]) && isset($_POST["pass"])) {
    $strSQL = "Select * from admin where username='" . $_POST["name"] . "' and " . "password='" . $_POST["pass"] . "'";

    $result = mysqli_query($conn, $strSQL);

    if (mysqli_num_rows($result) > 0) {
        echo "Chúc mừng bạn đã đăng nhập thành công";
    } else {
        echo "Đăng nhập không thành công. Vui lòng đăng nhập lại!!!";
    }
}
$_SESSION = [];
session_destroy();
mysqli_close($conn);
?>