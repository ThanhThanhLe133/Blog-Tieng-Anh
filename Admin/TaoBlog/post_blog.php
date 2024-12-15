<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    echo "<script>
        alert('Vui lòng đăng nhập!');
        window.location.href = '../ login/index.php';
    </script>";
    exit;
}
$user_id = $_SESSION['user_id'];

include('../conn.php');

$category = $_POST['category'];
$title = $_POST['title'];
$strSQL = "SELECT category_id FROM categories WHERE category_name = '$category'";
$result = $conn->query($strSQL);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $category_id = $row['category_id'];

    $strSQL_admin = "SELECT admin_id FROM admin WHERE username = '$user_id'";
    $result_admin = $conn->query($strSQL_admin);
    $author_id = $result_admin->fetch_assoc()['admin_id'];

    $sql = "INSERT INTO blogs (category_id, title, author_id) 
            VALUES ('$category_id', '$title','$author_id')";
    if ($conn->query($sql) === TRUE) {
        $blog_id = $conn->insert_id;
        echo $blog_id;
    } else {
        echo "Error inserting blog";
    }
} else {
    echo "Category không tồn tại trong cơ sở dữ liệu.";
}

$conn->close();
?>