<?php
session_start();

if (!isset($_SESSION['user_name'])) {
    echo "No";
    exit;
}

?>