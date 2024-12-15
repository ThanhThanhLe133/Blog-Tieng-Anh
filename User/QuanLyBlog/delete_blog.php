<?php
include('../conn.php');

// Kiểm tra nếu form đã được gửi
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $blog_id = $_POST['id'];  // ID của bài blog cần xóa

    // Xóa hình ảnh liên quan đến bài viết nếu có
    $query = "SELECT images FROM blogs WHERE blog_id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $blog_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $image_path = $row['images'];

        // Xóa hình ảnh nếu tồn tại
        if ($image_path && file_exists($image_path)) {
            unlink($image_path);
        }

        // Xóa bài blog khỏi cơ sở dữ liệu
        $query = "DELETE FROM blogs WHERE blog_id = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("i", $blog_id);
        $stmt->execute();

        // Kiểm tra xem thao tác xóa blog có thành công không
        if ($stmt->affected_rows > 0) {
            // Chuyển hướng về trang post.php và gửi thông báo thành công
            header("Location: post.php?alert=success&message=" . urlencode("Bài viết đã được xóa thành công!"));
        } else {
            // Chuyển hướng về trang post.php và gửi thông báo lỗi
            header("Location: post.php?alert=error&message=" . urlencode("Có lỗi khi xóa bài viết!"));
        }
    } else {
        // Nếu không tìm thấy bài viết trong cơ sở dữ liệu
        header("Location: post.php?alert=error&message=" . urlencode("Không tìm thấy bài viết cần xóa!"));
    }

    // Dừng tiếp tục thực thi mã sau khi chuyển hướng
    exit;
}
?>
