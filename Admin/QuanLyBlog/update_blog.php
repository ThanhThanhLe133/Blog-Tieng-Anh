<?php
include('../conn.php');

// Kiểm tra nếu form đã được gửi
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $blog_id = $_POST['id'];         // ID của blog cần cập nhật
    $category = $_POST['category'];  // Loại blog
    $title = $_POST['title'];        // Tiêu đề blog
    $content = $_POST['content'];    // Nội dung blog
    $current_image = $_POST['current_image']; // Lấy hình ảnh hiện tại

    // Xử lý hình ảnh nếu có
    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        $image = $_FILES['image'];
        $image_name = $image['name'];
        $image_tmp = $image['tmp_name'];
        $image_path = 'uploads/' . $image_name;

        // Di chuyển hình ảnh vào thư mục uploads
        if (!move_uploaded_file($image_tmp, $image_path)) {
            $image_url = $current_image; // Lỗi khi upload, giữ lại ảnh hiện tại
        } else {
            $image_url = $image_path; // Upload thành công
        }
    } else {
        $image_url = $current_image; // Nếu không có hình ảnh mới, giữ lại ảnh hiện tại
    }

    // Tìm category_id từ cơ sở dữ liệu
    $query = "SELECT category_id FROM categories WHERE category_name = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $category);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $category_id = $result->fetch_assoc()['category_id'];

        // Cập nhật blog vào cơ sở dữ liệu mà không cần sử dụng author_id và author_type
        $query = "UPDATE blogs SET category_id = ?, title = ?, content = ?, images = ? WHERE blog_id = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("isssi", $category_id, $title, $content, $image_url, $blog_id);
        $stmt->execute();

        // Kiểm tra xem thao tác cập nhật có thành công không
        if ($stmt->affected_rows > 0) {
            // Chuyển hướng về trang post.php và gửi thông báo thành công
            header("Location: post.php?id=" . $blog_id . "&alert=success&message=" . urlencode("Bài viết đã được cập nhật thành công!"));
        } else {
            // Chuyển hướng về trang post.php và gửi thông báo lỗi
            header("Location: post.php?id=" . $blog_id . "&alert=error&message=" . urlencode("Có lỗi khi cập nhật bài viết!"));
        }
    } else {
        // Nếu không tìm thấy category_id
        header("Location: post.php?id=" . $blog_id . "&alert=error&message=" . urlencode("Category không tồn tại trong cơ sở dữ liệu."));
    }

    // Dừng tiếp tục thực thi mã sau khi chuyển hướng
    exit;
}
?>
