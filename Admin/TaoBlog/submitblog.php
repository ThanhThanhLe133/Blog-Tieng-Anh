<?php
// Kết nối đến cơ sở dữ liệu
include('../conn.php');

// Kiểm tra xem form đã được gửi hay chưa
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Lấy dữ liệu từ form
    $category = $_POST['category'];  // Loại blog
    $title = $_POST['title'];        // Tiêu đề blog
    $content = $_POST['content'];    // Nội dung blog

    // Xử lý file hình ảnh (nếu có)
    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        $image = $_FILES['image'];
        $image_name = $image['name'];
        $image_tmp = $image['tmp_name'];
        $image_path = 'uploads/' . $image_name;

        // Di chuyển hình ảnh vào thư mục uploads
        if (move_uploaded_file($image_tmp, $image_path)) {
            // Nếu upload thành công, lưu đường dẫn vào CSDL
            $image_url = $image_path;
        } else {
            $image_url = null; // Nếu không upload được hình ảnh
        }
    } else {
        $image_url = null; // Nếu không có hình ảnh
    }

    // Tìm ID của category từ cơ sở dữ liệu
    $query = "SELECT category_id FROM categories WHERE category_name = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $category);
    $stmt->execute();
    $result = $stmt->get_result();

    // Kiểm tra nếu category tồn tại trong cơ sở dữ liệu
    if ($result->num_rows > 0) {
        $category_id = $result->fetch_assoc()['category_id'];

        // Thêm blog vào CSDL
        $query = "INSERT INTO blogs (category_id, title, content, images) VALUES (?, ?, ?, ?)";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("isss", $category_id, $title, $content, $image_url);
        $stmt->execute();

        // Kiểm tra kết quả
        if ($stmt->affected_rows > 0) {
            $message = "Lưu thành công!";
        } else {
            $message = "Có lỗi khi thêm blog!";
        }
    } else {
        $message = "Category không tồn tại trong cơ sở dữ liệu.";
    }

    // Hiển thị thông báo
    echo "<script>alert('$message');</script>";
}
?>
