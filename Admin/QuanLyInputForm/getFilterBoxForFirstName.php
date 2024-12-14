<?php
include "../conn.php";
$sql = "SELECT DISTINCT firstName FROM guest";
$result = $conn->query($sql);
$firstName="";
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $firstName .= '<label><input type="checkbox" value="' . $row['firstName'] . '"> ' . $row['firstName'] . '</label><br>';
    }
}

echo $firstName;

$conn->close();
?>