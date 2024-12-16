<?php

include "../../../conn.php";
$blog_id = $_POST['blog_id'];

$sql = "SELECT comment.comment_id, comment.comment, comment.created_at, users.f_name, users.l_name 
FROM comment 
JOIN users ON users.users_id = comment.user_id 
WHERE comment.blog_id = '$blog_id' 
ORDER BY comment.created_at ASC";
$result = $conn->query($sql);
$html = "";
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $html .= '<div class="comment" id="commentUser" data-comment_id="' . htmlspecialchars($row['comment_id']) . '">
        <div><span class="name">@' . htmlspecialchars($row['f_name']) . ' ' . htmlspecialchars($row['l_name']) . '</span></div>
        <div class="datetime">' . htmlspecialchars($row['created_at']) . '</div>
        <div class="comment">' . htmlspecialchars($row['comment']) . '</div>
        <button class="text-red-500 hover:text-red-700 deleteBtn">
            <i class="fas fa-trash"></i>
        </button>
    </div>';
    }
    echo $html;
} else {
    echo "Không tìm thấy bản ghi.";
}

$conn->close();
?>