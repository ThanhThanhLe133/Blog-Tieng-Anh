<?php
include "../../../conn.php";
session_start();
$comment = $_POST['comment'];
$blog_id = $_POST['blog_id'];
$user_id=$_SESSION['user_id'];
$username=$_SESSION['username'];

$strSQL = "INSERT INTO comment (comment, blog_id, user_id) 
               VALUES ('$comment', '$blog_id', '$user_id')";
$html="";
if ($conn->query($strSQL) === TRUE) {
    $sql = "SELECT * FROM users 
            JOIN comment ON comment.user_id = users.user_id 
            WHERE users.user_id = '$user_id' AND comment.comment = '$comment'";
    $result = $conn->query($sql);

    if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $html = '<div class="comment" data-comment_id=$row['comment_id']>
                    <div>@<span class="name">' . htmlspecialchars($row['f_name']) . ' ' . htmlspecialchars($row['l_name']) . '</span></div>
                    <div class="datetime">' . htmlspecialchars($row['created_at']) . '</div>
                    <div class="comment">' . htmlspecialchars($comment) . '</div>
                    <button class='text-red-500 hover:text-red-700 deleteBtn'>
                    <i class='fas fa-trash'></i>
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