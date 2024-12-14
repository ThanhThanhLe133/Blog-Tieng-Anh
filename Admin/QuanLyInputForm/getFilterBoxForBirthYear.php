<?php
include "../conn.php";
$sql = "SELECT DISTINCT birthYear FROM guest";
$result = $conn->query($sql);
$birthYears="";
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $birthYears .= '<label><input type="checkbox" value="' . $row['birthYear'] . '"> ' . $row['birthYear'] . '</label><br>';
    }
}

echo $birthYears;
$conn->close();
?>