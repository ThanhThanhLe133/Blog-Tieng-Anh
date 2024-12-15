<?php
include "../conn.php";
$blog_id = $_POST['blog_id'];

$sql = "SELECT * FROM blogs WHERE blog_id='$blog_id'";
$result = $conn->query($sql);
$html = "";
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $sql_image_title = "SELECT * FROM blog_images_title WHERE blog_id = $blog_id";

    $result_image_title = $conn->query($sql_image_title);
    $image_title_url = '';
    if ($result_image_title && $result_image_title->num_rows > 0) {
        $image_title_row = $result_image_title->fetch_assoc();
        $image_data = $image_title_row['image'];

        $image_title_url = 'data:image/jpeg;base64,' . base64_encode($image_data);
    }

    $html .= "<h1 class='text-2xl font-bold mb-4'>Sửa blog</h1>";

    $html .= '<div class="mb-4">
        <label class="block text-gray-700 text-sm font-bold mb-2" for="category">Loại blog</label>
        <select id="category" name="category">
            <option value="1" ' . ($row['category_id'] == 1 ? 'selected' : '') . '>Tiếng anh trẻ em</option>
            <option value="2" ' . ($row['category_id'] == 2 ? 'selected' : '') . '>Tin tức - Sự kiện</option>
            <option value="3" ' . ($row['category_id'] == 3 ? 'selected' : '') . '>Nuôi dạy con</option>
        </select>
    </div>';

    $html .= '<div class="mb-4">
        <label class="block text-gray-700 text-sm font-bold mb-2" for="title">Tiêu đề</label>
        <input
            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
            id="title" name="title" placeholder="Nhập tiêu đề của blog" type="text" value="' . htmlspecialchars($row['title'], ENT_QUOTES, 'UTF-8') . '">
    </div>';

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

    $html .= '<div class="mb-4">
    <label class="block text-gray-700 text-sm font-bold mb-2" for="content">Nội dung</label>
    <div id="editor"
         class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline ql-container ql-snow"
         style="height: 300px;">
        <div class="ql-editor ql-blank" data-gramm="false" contenteditable="true">
         ' . $content. '
            <p><br></p>
        </div>
    </div>
    </div>';

    if ($image_title_url) {
        $html .= "<div class='mb-4'>
                <label class='block text-gray-700 text-sm font-bold mb-2' for='image_title_display'>Hình ảnh tiêu đề hiện tại</label>
              <img alt='{$row['title']}' class='w-full mb-4' src='{$image_title_url}' style='height:100px; width:100px;'>
              </div>";
    }

    $html .= '<div class="mb-4">
    <label class="block text-gray-700 text-sm font-bold mb-2" for="image">Hình ảnh tiêu đề mới</label>
    <input
        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
        id="image_title" name="image" type="file">
        </div>';

    echo $html;
}
$conn->close();
?>