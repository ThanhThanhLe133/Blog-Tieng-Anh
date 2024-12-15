<?php
include "../conn.php";
$sql = "SELECT DISTINCT last_name FROM blogs
JOIN admin ON admin.admin_id=blogs.author_id";
$result = $conn->query($sql);
$author="";
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $last_name = htmlspecialchars($row['last_name'], ENT_QUOTES, 'UTF-8');
        $author .= '<label><input type="checkbox" value="' . $last_name . '"> ' . $last_name . '</label><br>';
    }
}

echo $author;
$conn->close();
?>