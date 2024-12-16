<?php
include "../conn.php";
$blog_id = $_POST['blog_id'];
$sql_delete = "DELETE FROM blog_images_title WHERE blog_id = '$blog_id'";
if ($conn->query($sql_delete)) {
    echo "success";
} else {
    echo "error";
}
