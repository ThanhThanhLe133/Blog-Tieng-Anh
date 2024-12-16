<?php
include "../../../conn.php";
session_start();
$comment_id = $_POST['comment_id'];

$sql = "DELETE from comment where comment_id='$comment_id'";
if ($conn->query($sql) === TRUE) {
    echo "success"; 
} else {
    echo $conn->error; 
}

$conn->close();

?>