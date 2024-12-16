<?php
session_start();
include "conn.php";

if (isset($_SESSION['user_name']) && $_SESSION['user_name'] === true) {
    echo 'true';

} else {
    echo 'false';
}
$conn->close();
?>