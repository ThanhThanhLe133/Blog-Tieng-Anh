<?php
include "../conn.php";

$id = $_POST['id']; 

$sql = "DELETE FROM guest WHERE id = '$id'";
if ($conn->query($sql) === TRUE) {
    echo "success"; 
} else {
    echo "error"; 
}

$conn->close();
?>