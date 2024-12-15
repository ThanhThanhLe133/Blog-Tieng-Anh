<?php
if (isset($_FILES['image_title']) && $_FILES['image_title']['error'] === UPLOAD_ERR_OK) {
    $imageTmpName = $_FILES['image_title']['tmp_name'];
    $imageName = $_FILES['image_title']['name'];
    $imageType = $_FILES['image_title']['type'];

    $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
    if (in_array($imageType, $allowedTypes)) {
        $imageData = file_get_contents($imageTmpName);

        include('../conn.php');
        $blog_id = $_POST['blog_id'];


        $sql_check = "SELECT * FROM blog_images_title WHERE blog_id = '$blog_id'";
        $result = $conn->query($sql_check);
        if ($result->num_rows > 0) {
            $sql_delete = "DELETE FROM blog_images_title WHERE blog_id = '$blog_id'";
            if ($conn->query($sql_delete) !== TRUE) {
                echo "Lỗi khi cập nhập hình ảnh tiêu đề";
                exit;
            }
            $sql = "INSERT INTO blog_images_title (blog_id, image) VALUES (?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ib", $blog_id, $null);
            $stmt->send_long_data(1, $imageData);

            if ($stmt->execute()) {
                echo "Hình ảnh đã được tải lên thành công!";
            } else {
                echo "Lỗi khi lưu hình ảnh vào cơ sở dữ liệu.";
            }
            $stmt->close();
        }
    } else {
        echo "Vui lòng chọn tệp hình ảnh hợp lệ (JPEG, PNG, GIF).";
    }
} else {
    echo "Không có hình ảnh được gửi lên.";
}
?>