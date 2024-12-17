<?php
include "../conn.php";

$blog_id = $_POST['blog_id'];
$content = $_POST['content'];

$sql_check = "SELECT * FROM blog_images_title WHERE blog_id = '$blog_id'";
$result = $conn->query($sql_check);
if ($result->num_rows > 0) {
    $sql_delete_images = "DELETE FROM blog_images WHERE blog_id = '$blog_id'";
    $sql_delete_content = "UPDATE blogs SET content = NULL WHERE blog_id = '$blog_id'";


    if ($conn->query($sql_delete_images) !== TRUE || $conn->query($sql_delete_content) !== TRUE) {
        echo "Lỗi khi cập nhập blog";
        exit;
    }
}

if (isset($_FILES['image_title']) && $_FILES['image_title']['error'] === UPLOAD_ERR_OK) {
    $imageTmpName = $_FILES['image_title']['tmp_name'];
    $imageName = $_FILES['image_title']['name'];
    $imageType = $_FILES['image_title']['type'];

    $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
    if (in_array($imageType, $allowedTypes)) {
        $imageData = file_get_contents($imageTmpName);

        $sql = "INSERT INTO blog_images_title (blog_id, image) VALUES (?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ib", $blog_id, $null);
        $stmt->send_long_data(1, $imageData);

        if ($stmt->execute()) {
            echo "Hình ảnh đã được tải lên thành công!";
        } else {
            echo "Lỗi khi lưu hình ảnh vào cơ sở dữ liệu.";
            exit;
        }
        $stmt->close();

    } else {
        echo "Vui lòng chọn tệp hình ảnh hợp lệ (JPEG, PNG, GIF).";
        exit;
    }
} else {
    echo "Không có hình ảnh tiêu đề được gửi lên.";
    exit;
}

// Lưu hình ảnh từ nội dung bài viết
preg_match_all('/<img[^>]+src="([^">]+)"/', $content, $matches);
$image_ids = [];

if (!empty($matches[1])) {
    foreach ($matches[1] as $image_url) {
        $blob = dataURItoBlob($image_url);

        if ($blob === false) {
            echo "Error: Invalid image data";
            exit;
        }
        $compressedBlob = compressImage($blob);
        if ($compressedBlob === false) {
            echo "Error: Could not compress image.";
            exit;
        }
        $sql = "INSERT INTO blog_images (blog_id, image) VALUES (?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ib", $blog_id, $null);
        $stmt->send_long_data(1, $compressedBlob);

        if ($stmt->execute()) {
            $image_id = $stmt->insert_id;
            $content = str_replace($image_url, "image_$image_id", $content);
        } else {
            echo "Error: Could not save image";
            exit;
        }
        $stmt->close();
    }
}

// Cập nhật nội dung bài viết
$sql_update = "update blogs set content='$content' where blog_id='$blog_id'";

if ($conn->query($sql_update) === TRUE) {
    echo "success";
} else {
    echo "error";
}
$conn->close();
function dataURItoBlob($dataURI)
{
    if (strpos($dataURI, ',') === false) {
        echo "Error: Data URI does not contain a comma<br>";
        return false;
    }

    $splitData = explode(',', $dataURI);
    if (count($splitData) !== 2) {
        echo "Error: Data URI is not properly formatted<br>";
        return false;
    }

    $data = base64_decode($splitData[1], true);
    if ($data === false) {
        echo "Error: Base64 decoding failed<br>";
        return false;
    }
    return $data;
}

function compressImage($blob, $quality = 75)
{
    $tempFile = tempnam(sys_get_temp_dir(), 'img');
    file_put_contents($tempFile, $blob);

    $imageInfo = getimagesize($tempFile);
    if ($imageInfo === false) {
        echo false;
    }

    switch ($imageInfo['mime']) {
        case 'image/jpeg':
            $image = imagecreatefromjpeg($tempFile);
            break;
        case 'image/png':
            $image = imagecreatefrompng($tempFile);
            break;
        case 'image/gif':
            $image = imagecreatefromgif($tempFile);
            break;
        default:
            echo false; // Không hỗ trợ loại hình ảnh này
    }

    // Nén hình ảnh và lưu vào tệp tạm
    ob_start(); // Bắt đầu ghi vào bộ đệm
    switch ($imageInfo['mime']) {
        case 'image/jpeg':
            imagejpeg($image, null, $quality);
            break;
        case 'image/png':
            imagepng($image, null, round($quality / 10)); // Chất lượng cho PNG từ 0 đến 9
            break;
        case 'image/gif':
            imagegif($image);
            break;
    }
    ob_start();
    imagejpeg($image, null, $quality);
    $compressedBlob = ob_get_clean();
    imagedestroy($image);
    unlink($tempFile);

    return $compressedBlob;
}
?>