<?php

include "../../conn.php";
$page = $_POST['page'];
$items_per_page = 3;

$sql_count = "SELECT COUNT(*) as total FROM blogs WHERE category_id = 3";
$count_result = $conn->query($sql_count);
$row_count = $count_result->fetch_assoc();
$total_blogs = $row_count['total'];
$offset = ($page - 1) * $items_per_page;

$sql = "SELECT * FROM blogs WHERE category_id = 3 ORDER BY created_at DESC LIMIT $items_per_page OFFSET $offset";
$result = $conn->query($sql);
$html = "";
if ($result->num_rows > 0) {

    while ($row = $result->fetch_assoc()) {
        $blog_id = $row['blog_id'];

        $sql_image_title = "SELECT * FROM blog_images_title WHERE blog_id = $blog_id";

        $result_image_title = $conn->query($sql_image_title);
        $image_title_url = '';
        if ($result_image_title && $result_image_title->num_rows > 0) {
            $image_title_row = $result_image_title->fetch_assoc();
            $image_data = $image_title_row['image'];

            $image_title_url = 'data:image/jpeg;base64,' . base64_encode($image_data);
        }
        $html .= " <div class='bg-white rounded-lg shadow-md mb-6 blog-list' data-id='{$row['blog_id']}'>
                <div class='flex' style='margin: 30px;padding: 20px'>
                    <img alt='{$row['title']}' class='w-1/3 h-auto rounded-l-lg' height='200' src='{$image_title_url}' width='300'>
                    <div class='p-4 w-2/3'>
                        <h2 class='text-xl font-bold mb-2'>{$row['title']}</h2>
                        <p class='text-gray-500 text-sm mb-2'>
                            <i class='far fa-calendar-alt'></i> " . date("F d, Y", strtotime($row['created_at'])) . "
                            <span class='mx-1'>|</span>
                            <i class='fas fa-user'></i> Tiếng Anh trẻ em
                        </p>
                        <p class='text-gray-700 mb-4'>";

        $contentWithoutImg = preg_replace('/<img[^>]*>/i', '', $row['content']);
        $html .= substr($contentWithoutImg, 0, 250) . '...';

        $html .= "</p>
                        <a class='text-blue-500 font-semibold' href='../blogDetail/index.html?blog_id={$row['blog_id']}'>Đọc Thêm</a>
                    </div>
                </div>
            </div>";

    }
    echo $html;
}
$conn->close();
?>
