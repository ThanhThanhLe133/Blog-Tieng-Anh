<?php
include "../conn.php";
$sql = "SELECT DISTINCT f_name FROM users";
$result = $conn->query($sql);
$firstName="";
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $firstName .= '<label><input type="checkbox" value="' . $row['f_name'] . '"> ' . $row['f_name'] . '</label><br>';
    }
}

echo $firstName;

$conn->close();
?>