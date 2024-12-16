<?php
include "../../../conn.php";
session_start();
$comment = $_POST['comment'];
$blog_id = $_POST['blog_id'];
$users_id = $_SESSION['users_id'];
$username = $_SESSION['username'];

$strSQL = "INSERT INTO comment (comment, blog_id, user_id) 
               VALUES ('$comment', '$blog_id', '$users_id')";
$html = "";
if ($conn->query($strSQL) === TRUE) {
    $sql = "SELECT * FROM users 
            JOIN comment ON comment.user_id = users.users_id 
            WHERE users.users_id = '$users_id' AND comment.comment = '$comment'";
    $result = $conn->query($sql);

    if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $html = '<div class="comment" id="comment" data-comment_id="' . htmlspecialchars($row['comment_id']) . '">
        <div><span class="name">@' . htmlspecialchars($row['f_name']) . ' ' . htmlspecialchars($row['l_name']) . '</span></div>
        <div class="datetime">' . htmlspecialchars($row['created_at']) . '</div>
        <div class="comment">' . htmlspecialchars($comment) . '</div>
        <button class="text-red-500 hover:text-red-700 deleteBtn" style="display:none">
            <i class="fas fa-trash"></i>
        </button>
    </div>';
        echo $html;
    } else {
        echo "Không tìm thấy bản ghi.";
    }
} else {
    echo "Lỗi khi truy vấn: " . $conn->error;
}

$conn->close();

?>