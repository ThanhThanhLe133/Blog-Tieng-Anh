<?php
include "../../../conn.php";
$blog_id = $_POST['blog_id'];
$html="";
$prev_sql = "SELECT * FROM blogs WHERE category_id=2 AND blog_id < $blog_id ORDER BY blog_id DESC LIMIT 1";
$result_prev = $conn->query($prev_sql);
if ($result_prev->num_rows > 0) {
    $row=$result_prev->fetch_assoc();
    $html.= "<div><a class='text-blue-600' href='index.html?blog_id={$row['blog_id']}'>PREVIOUS</a>
                        <h3 class='font-semibold'>{$row['title']}</h3></div>";
}
else {
    $html .= "<div style='flex: 1;'></div>";
}
$next_sql = "SELECT * FROM blogs WHERE blog_id > $blog_id ORDER BY blog_id ASC LIMIT 1";
$result_next = $conn->query($next_sql);
if ($result_next->num_rows > 0) {
    $row=$result_next->fetch_assoc();
    $html.= "<div><a class='text-blue-600' href='index.html?blog_id={$row['blog_id']}'>NEXT</a>
    <h3 class='font-semibold'>{$row['title']}</h3></div>";
}
else {
    $html .= "<div style='flex: 1;'></div>";
}
echo $html;
$conn->close();
?>