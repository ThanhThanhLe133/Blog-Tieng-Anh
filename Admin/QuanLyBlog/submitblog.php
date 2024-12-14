<?php
include('../conn.php');

// Kiểm tra nếu form đã được gửi
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $category = $_POST['category'];  // Loại blog
    $title = $_POST['title'];        // Tiêu đề blog
    $content = $_POST['content'];    // Nội dung blog

    // Xử lý hình ảnh nếu có
    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        $image = $_FILES['image'];
        $image_name = $image['name'];
        $image_tmp = $image['tmp_name'];
        $image_path = 'uploads/' . $image_name;

        // Di chuyển hình ảnh vào thư mục uploads
        if (!move_uploaded_file($image_tmp, $image_path)) {
            $image_url = null; // Lỗi khi upload
        } else {
            $image_url = $image_path; // Upload thành công
        }
    } else {
        $image_url = null; // Nếu không có hình ảnh
    }

    // Tìm category_id từ cơ sở dữ liệu
    $query = "SELECT category_id FROM categories WHERE category_name = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $category);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $category_id = $result->fetch_assoc()['category_id'];

        // Thêm blog vào cơ sở dữ liệu
        $query = "INSERT INTO blogs (category_id, title, content, images) VALUES (?, ?, ?, ?)";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("isss", $category_id, $title, $content, $image_url);
        $stmt->execute();

        // Kiểm tra xem thao tác lưu blog có thành công không
        if ($stmt->affected_rows > 0) {
            // Chuyển hướng về trang post.php và gửi thông báo thành công
            header("Location: post.php?alert=success&message=" . urlencode("Bài viết đã được lưu thành công!"));
        } else {
            // Chuyển hướng về trang post.php và gửi thông báo lỗi
            header("Location: post.php?alert=error&message=" . urlencode("Có lỗi khi thêm blog!"));
        }
    } else {
        // Nếu không tìm thấy category_id
        header("Location: post.php?alert=error&message=" . urlencode("Category không tồn tại trong cơ sở dữ liệu."));
    }

    // Dừng tiếp tục thực thi mã sau khi chuyển hướng
    exit;
}
?>
