<?php
session_start();
$user_name = $_SESSION['user_name'];

include('../conn.php');

$category_id = isset($_POST['category_id']) ? intval($_POST['category_id']) : 0;
$title = isset($_POST['title']) ? trim($_POST['title']) : '';
$blog_id = isset($_POST['blog_id']) ? intval($_POST['blog_id']) : 0;


$strSQL_admin = "SELECT admin_id FROM admin WHERE username = ?";
$stmt_admin = $conn->prepare($strSQL_admin);
$stmt_admin->bind_param("s", $user_name);
$stmt_admin->execute();
$result_admin = $stmt_admin->get_result();

if ($result_admin->num_rows > 0) {
    $author_id = $result_admin->fetch_assoc()['admin_id'];

    if (!empty($blog_id)) {
        $sql_update = "UPDATE blogs SET author_id = ?, category_id = ?, title = ? WHERE blog_id = ?";
        $stmt_update = $conn->prepare($sql_update);
        $stmt_update->bind_param("iisi", $author_id, $category_id, $title, $blog_id);

        if ($stmt_update->execute()) {
            echo $blog_id; 
        } else {
            echo "Không thể cập nhật blog. Vui lòng thử lại.";
        }
        $stmt_update->close();
        exit;
    }

    $sql_insert = "INSERT INTO blogs (category_id, title, author_id) VALUES (?, ?, ?)";
    $stmt_insert = $conn->prepare($sql_insert);
    $stmt_insert->bind_param("isi", $category_id, $title, $author_id);

    if ($stmt_insert->execute()) {
        $blog_id = $stmt_insert->insert_id; 
        echo $blog_id;
    } else {
        echo "Lỗi khi tạo blog: " . $stmt_insert->error;
    }
    $stmt_insert->close();
} else {
    echo "Người dùng không tồn tại trong cơ sở dữ liệu.";
}

$conn->close();
?>