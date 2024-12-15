<?php
include('../conn.php');

$category = $_POST['category'];
$title = $_POST['title'];


$strSQL = "SELECT category_id FROM categories WHERE category_name = '$category'";
$result = $conn->query($strSQL);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $category_id = $row['category_id'];

    $sql = "INSERT INTO blogs (category_id, title) 
            VALUES ('$category_id', '$title')";
    if ($conn->query($sql) === TRUE) {
        $strSql = "SELECT blog_id FROM blogs WHERE category_id = '$category_id' ORDER BY created_at DESC LIMIT 1";

        $result = $conn->query($strSql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $blog_id = $row['blog_id']; 
            echo $blog_id; 
        } else {
            echo "Error fetching blog ID";
        }
    } else {
        echo "Error inserting blog";
    }
} else {
    echo "Category không tồn tại trong cơ sở dữ liệu.";
}

$conn->close();
?>