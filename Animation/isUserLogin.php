<?php
session_start();
include "conn.php";

if (isset($_SESSION['user_logged_in']) && $_SESSION['user_logged_in'] === true) {
    echo "yes";

} else {
    echo "no";
}
$conn->close();
?>