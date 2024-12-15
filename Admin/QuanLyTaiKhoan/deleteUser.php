<?php
include "../conn.php";

$users_id  = $_POST['users_id ']; 

$sql = "DELETE FROM users WHERE users_id  = $users_id ";
if ($conn->query($sql) === TRUE) {
    echo "success"; 
} else {
    echo "error"; 
}

$conn->close();
?>