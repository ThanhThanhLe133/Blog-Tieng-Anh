<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "";
$DBName = "BLOGTIENGANH";

$conn = mysqli_connect($servername, $username, $password, $DBName)
    or die("<p>Không thể connect</p>" . "<p>Error code: " . mysqli_connect_error() . ": " . mysqli_connect_error() . "</p>");

mysqli_set_charset($conn, "utf8");
$user_id = $_SESSION['user_id'];
if (isset($_POST["firstname"]) && isset($_POST["lastname"]) && isset($_POST["username"])&& isset($_POST["email"])) {
    $strSQL = "UPDATE admin SET ".
                "first_name='" . $_POST["firstname"] . "', " . 
              "last_name='" . $_POST["lastname"] . "', " . 
              "username='" . $_POST["username"] . "', " . 
              "email='" . $_POST["email"] . "' " . 
              "WHERE username = '$user_id'"; 

    $result = mysqli_query($conn, $strSQL);

    if ($result) {
        $_SESSION['user_logged_in'] = true;
        $_SESSION['user_id'] = $_POST["username"];
        echo "Cập nhật thông tin thành công!";
    } else {
        echo "Không thể cập nhật thông tin. Vui lòng thử lại.";
    }
}

mysqli_close($conn);
?>