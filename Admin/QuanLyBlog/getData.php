<?php

session_start();

if (!isset($_SESSION['user_id'])) {
    echo "<script>
        alert('Vui lòng đăng nhập!');
        window.location.href = '../ login/index.php';
    </script>";
    exit;
}
include "../conn.php";
$sql = "SELECT * FROM blogs";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $html="";
    while ($row = $result->fetch_assoc()) {
        $author_id = $row['author_id'];
        $category_id = $row['category_id'];

        $sql_author = "SELECT first_name FROM admin WHERE admin_id = $author_id";
        $result_author = $conn->query($sql_author);
        $author = ($result_author && $result_author->num_rows > 0) ? $result_author->fetch_assoc()['first_name'] : 'Unknown';

        $sql_category = "SELECT category_name FROM categories WHERE category_id = $category_id";
        $result_category = $conn->query($sql_category);
        $category = ($result_category && $result_category->num_rows > 0) ? $result_category->fetch_assoc()['category_name'] : 'Unknown';
        $html .= "

        <tr data-id='{$row['blog_id']}'>
            <td class='py-2 px-4 border-b border-gray-200 title_blog'>{$row['title']}</td>
            <td class='py-2 px-4 border-b border-gray-200 author'>{$author}</td>
            <td class='py-2 px-4 border-b border-gray-200 created_at'>{$row['created_at']}</td>
            <td class='py-2 px-4 border-b border-gray-200 updated_at'>{$row['updated_at']}</td>
            <td class='py-2 px-4 border-b border-gray-200 category'>{$category}</td>
            <td class='py-2 px-4 border-b border-gray-200'>
             <button class='text-blue-500 hover:text-red-700 deleteBtn'>
                    <i class='fas fa-edit'></i>
                </button>
                <button class='text-red-500 hover:text-red-700 deleteBtn'>
                    <i class='fas fa-trash'></i>
                </button>
            </td>
        </tr>";
    }
    echo $html;
}
$conn->close();
?>