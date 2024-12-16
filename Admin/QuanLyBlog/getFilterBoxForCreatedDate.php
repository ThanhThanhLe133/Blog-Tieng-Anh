<?php
include "../conn.php";
$sql = "SELECT DISTINCT DATE_FORMAT(created_at, '%d/%m/%Y') AS formattedDate FROM blogs";
$result = $conn->query($sql);
$formattedDate="";
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $formattedDate .= '<label><input type="checkbox" value="'.$row['formattedDate'].'"> ' . $row['formattedDate'] . '</label><br>';
    }
}
echo $formattedDate;
$conn->close();
?>