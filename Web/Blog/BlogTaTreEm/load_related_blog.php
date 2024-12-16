<?php

include "../../conn.php";
$blog_id = $_POST['blog_id'];
$sql = "SELECT * FROM blogs where category_id=1 AND blog_id < $blog_id ORDER BY blog_id DESC LIMIT 4";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $html = "";
    while ($row = $result->fetch_assoc()) {
        $sql_image_title = "SELECT * FROM blog_images_title WHERE blog_id = {$row['blog_id']}";

        $result_image_title = $conn->query($sql_image_title);
        $image_title_url = '';
        if ($result_image_title && $result_image_title->num_rows > 0) {
            $image_title_row = $result_image_title->fetch_assoc();
            $image_data = $image_title_row['image'];

            $image_title_url = 'data:image/jpeg;base64,' . base64_encode($image_data);
        }
        $html .= "
        <div class='bg-white shadow-md rounded-lg overflow-hidden blog-card'>
            <img alt='{$row['title']}' class='w-full h-40 object-cover'
                 height='400' src='{$image_title_url}' width='600'>
            <div class='p-4'>
                <h3 class='text-lg font-semibold mb-2'>
                    {$row['title']}
                </h3>
                <p class='text-gray-600 text-sm mb-2'>
                    <i class='fas fa-calendar-alt'></i>
                    " . date("F d, Y", strtotime($row['created_at'])) . "
                </p>
                <p class='text-gray-600 text-sm'>
                    <i class='fas fa-folder-open'></i>
                    Nuôi Dạy Con
                </p>
            </div>
        </div>";
    }
    echo $html;
}
$conn->close();
?>