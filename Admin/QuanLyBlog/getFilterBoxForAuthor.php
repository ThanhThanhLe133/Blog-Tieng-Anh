<?php
include "../conn.php";
$sql = "SELECT DISTINCT admin.first_name 
        FROM admin
        JOIN blogs ON admin.admin_id = blogs.author_id";
$result = $conn->query($sql);
$author="";
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $first_name = htmlspecialchars($row['first_name'], ENT_QUOTES, 'UTF-8');
        $author .= '<label><input type="checkbox" value="' . $first_name . '"> ' . $first_name . '</label><br>';
    }
}
else {
    $author = "Không có tác giả nào được tìm thấy.";
}
echo $author;
$conn->close();
?>