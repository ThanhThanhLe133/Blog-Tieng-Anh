<?php
include "../conn.php";

$blog_id = $_POST['blog_id'];
$content = $_POST['content'];

// preg_match_all('/<img[^>]+src="([^">]+)"/', $image_title, $matches);
// $image_ids = [];

// if (!empty($matches[1])) {
//     foreach ($matches[1] as $image_url) {
//         $blob_title = dataURItoBlob($image_url);
//         if ($blob_title === false) {
//             echo "Error: Invalid image data";
//             exit;
//         }
//         $sql = "INSERT INTO blog_images_title (blog_id, image) VALUES (?, ?)";
//         $stmt = $conn->prepare($sql);
//         if ($stmt === false) {
//             echo "Error: Could not prepare SQL statement.";
//             exit;
//         }
//         $stmt->bind_param("ib", $blog_id, $null);
//         $stmt->send_long_data(1, $blob_title);
//         if ($stmt->execute()) {
//         } else {
//             echo "Error: Could not save image title";
//             exit;
//         }
//         $stmt->close();
//     }
// }

preg_match_all('/<img[^>]+src="([^">]+)"/', $content, $matches);
$image_ids = [];

if (!empty($matches[1])) {
    foreach ($matches[1] as $image_url) {
        $blob = dataURItoBlob($image_url);

        if ($blob === false) {
            echo "Error: Invalid image data";
            exit;
        }
        $sql = "INSERT INTO blog_images (blog_id, image) VALUES (?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ib", $blog_id, $null);
        $stmt->send_long_data(1, $blob);

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

    $data = base64_decode($splitData[1], true);
    if ($data === false) {
        echo "Error: Base64 decoding failed<br>";
        return false;
    }

    return $data;
}

$conn->close();
?>