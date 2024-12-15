<?php
include "../conn.php";
$sql = "SELECT DISTINCT DATE_FORMAT(updated_at, '%d/%m/%Y') AS formattedDate FROM users";
$result = $conn->query($sql);
$formattedDate="";
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $formattedDate .= '<label><input type="checkbox" value="' . $row['formattedDate'] . '"> ' . $row['formattedDate'] . '</label><br>';
    }
}
echo $formattedDate;
$conn->close();
?>