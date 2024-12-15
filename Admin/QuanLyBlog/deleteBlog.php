<?php
include "../conn.php";

$blog_id  = $_POST['blog_id']; 

$sql_image_title = "DELETE FROM blogs_images_title WHERE blog_id  = '$blog_id' ";
$sql_images = "DELETE FROM blogs_images WHERE blog_id  = '$blog_id' ";
$sql_blogs = "DELETE FROM blogs WHERE blog_id  = '$blog_id' ";
if ($conn->query($sql_image_title) === TRUE && $conn->query($sql_images ) === TRUE) {
   if($conn->query($sql_blogs)){
    echo "success"; 
   };
} else {
    echo "error"; 
}

$conn->close();
?>