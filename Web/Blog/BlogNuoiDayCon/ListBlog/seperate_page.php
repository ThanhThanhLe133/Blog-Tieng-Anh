<?php
include "../../conn.php";
$page = $_POST['page'];
$items_per_page = 3;

$sql_count = "SELECT COUNT(*) as total FROM blogs WHERE category_id = 3";
$count_result = $conn->query($sql_count);
$row_count = $count_result->fetch_assoc();
$total_blogs = $row_count['total'];
$total_pages = ceil($total_blogs / $items_per_page);
$html="";
if ($page > 1) {
    $html.= "<li><a class='py-2 px-3 leading-tight text-gray-500 bg-white rounded-l-lg border border-gray-300 hover:bg-gray-100 hover:text-gray-700' href='index.html?page=" . ($page - 1) . "'>
            <span class='sr-only'>Previous</span>
            <i class='fas fa-chevron-left'></i>
          </a></li>";
}

for ($i = 1; $i <= $total_pages; $i++) {
    $html.= "<li><a class='py-2 px-3 leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700' href='index.html?page=$i'>$i</a></li>";
}

if ($page < $total_pages) {
    $html.= "<li><a class='py-2 px-3 leading-tight text-gray-500 bg-white rounded-r-lg border border-gray-300 hover:bg-gray-100 hover:text-gray-700' href='index.html?page=" . ($page + 1) . "'>
            <span class='sr-only'>Next</span>
            <i class='fas fa-chevron-right'></i>
          </a></li>";
}
echo $html;
$conn->close();
?>