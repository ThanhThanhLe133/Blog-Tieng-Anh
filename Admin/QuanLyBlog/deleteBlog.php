<?php
include "../conn.php";

$blog_id = $_POST['blog_id'];

$sql_img_title = "SELECT * FROM blog_images_title WHERE blog_id = $blog_id";
$result1 = $conn->query($sql_img_title);
$sql_img = "SELECT * FROM blog_images WHERE blog_id = $blog_id";
$result2 = $conn->query($sql_img);

if($result1->num_rows>0)
{
    $sql_image_title = "DELETE FROM blog_images_title WHERE blog_id  = '$blog_id' ";
    $conn->query($sql_image_title);
}
if($result2->num_rows>0)
{
    $sql_images= "DELETE FROM blog_images WHERE blog_id  = '$blog_id' ";
    $conn->query($sql_images);
}
$sql_blogs = "DELETE FROM blogs WHERE blog_id  = '$blog_id' ";
if ($conn->query($sql_blogs)) {
    echo "success";
} else {
    echo "error";
}

$conn->close();
?>