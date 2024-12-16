<?php

include "../../../conn.php";
$blog_id = $_POST['blog_id'];

$sql = "SELECT * FROM blogs WHERE blog_id='$blog_id'";
$result = $conn->query($sql);
$html = "";
if ($result->num_rows > 0) {
    $row=$result->fetch_assoc();
    $sql_image_title = "SELECT * FROM blog_images_title WHERE blog_id = $blog_id";

    $result_image_title = $conn->query($sql_image_title);
    $image_title_url = '';
    if ($result_image_title && $result_image_title->num_rows > 0) {
        $image_title_row = $result_image_title->fetch_assoc();
        $image_data = $image_title_row['image'];

        $image_title_url = 'data:image/jpeg;base64,' . base64_encode($image_data);
    }
    $html .= "<h1 class='text-2xl font-bold mb-4'>{$row['title']}</h1>";
    $html .= "<div class='flex items-center text-gray-500 text-sm mb-4'>
                        <span>" . date("F d, Y", strtotime($row['created_at'])) . "</span>
                        <span class='mx-2'>|</span>
                        <span>Nuôi Dạy Con</span>
                      </div>";

    if ($image_title_url) {
        $html .= "<img alt='{$row['title']}' class='w-full mb-4' src='{$image_title_url}' id='imageblog'>";
    }
    $content = $row['content'];
    preg_match_all('/<img src="([^"]+)"/', $content, $matches);

    // Duyệt qua từng thẻ <img> và thay thế src bằng hình ảnh tương ứng
    if (!empty($matches[1])) {
        foreach ($matches[1] as $img_src) {
          
            preg_match('/image_(\d+)/', $img_src, $img_id_match);

            if (!empty($img_id_match[1])) {
                $img_id = $img_id_match[1];

                $sql_image_title = "SELECT * FROM blog_images WHERE image_id = $img_id";
                $result_image_title = $conn->query($sql_image_title);
                $image_title_url = '';

                if ($result_image_title && $result_image_title->num_rows > 0) {
                    $image_title_row = $result_image_title->fetch_assoc();
                    $image_data = $image_title_row['image'];
                    $image_title_url = 'data:image/jpeg;base64,' . base64_encode($image_data);
                }

                $content = str_replace($img_src, $image_title_url, $content);
            }
        }
    }
    $html .= "<div class='text-gray-700 mb-4' id='contentBlog'>{$content}</div>";
    echo $html;
}
$conn->close();
?>