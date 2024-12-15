<?php
include "../conn.php";

$blog_id = $_POST['blog_id'];
$content = $_POST['content'];

preg_match_all('/<img[^>]+src="([^">]+)"/', $content, $matches);
$image_ids = [];

if (!empty($matches[1])) {
    foreach ($matches[1] as $image_url) {
        $blob = dataURItoBlob($image_url);

        if ($blob === false) {
            echo "Error: Invalid image data";
            exit;
        }

        // Insert the image blob into the blog_images table
        $sql = "INSERT INTO blog_images (blog_id, image) VALUES (?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ib", $blog_id, $blob);
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
$sql = "update blogs set content='$content' where blog_id='$blog_id'";

if ($conn->query($sql) === TRUE) {
    echo "success";
} else {
    echo "error";
}

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

    $data = base64_decode($splitData[1], true); // Sử dụng decode strict
    if ($data === false) {
        echo "Error: Base64 decoding failed<br>";
        return false;
    }

    return $data;
}

$conn->close();
?>