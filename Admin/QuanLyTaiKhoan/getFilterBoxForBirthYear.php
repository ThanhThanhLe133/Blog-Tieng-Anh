<?php
include "../conn.php";
$sql = "SELECT DISTINCT birth_year FROM users";
$result = $conn->query($sql);
$birthYears="";
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $birthYears .= '<label><input type="checkbox" value="' . $row['birth_year'] . '"> ' . $row['birth_year'] . '</label><br>';
    }
}

echo $birthYears;
$conn->close();
?>