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
$blog_id = $_SESSION['blog_id'];

include('../conn.php');

$category_id = $_POST['category_id'];
$title = $_POST['title'];
$strSQL_admin = "SELECT admin_id FROM admin WHERE username = '$user_id'";
$result_admin = $conn->query($strSQL_admin);

if ($result_admin->num_rows > 0) {
    $author_id = $result_admin->fetch_assoc()['admin_id'];

    if($blog_id!==null){
        $sql_update = "UPDATE blogs SET author_id = '$author_id',category_id='$category_id',title='$title' WHERE blog_id = '$blog_id'";
        if ($conn->query($sql_update) === TRUE) {
            echo $blog_id;
        } else {
            echo "Không thể cập nhật blogs. Vui lòng thử lại.";
        }
        exit;
    }

    $sql = "INSERT INTO blogs (category_id, title, author_id) 
            VALUES ('$category_id', '$title','$author_id')";
    if ($conn->query($sql) === TRUE) {
        $blog_id = $conn->insert_id;
        echo $blog_id;
    } else {
        echo "Lỗi khi tạo blog";
    }
} else {
    echo "Category không tồn tại trong cơ sở dữ liệu.";
}

$conn->close();
?>