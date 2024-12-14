<?php
include "../conn.php";
$sql = "SELECT DISTINCT lastName FROM guest";
$result = $conn->query($sql);
$lastName="";
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $lastName .= '<label><input type="checkbox" value="' . $row['lastName'] . '"> ' . $row['lastName'] . '</label><br>';
    }
}

echo $lastName;
$conn->close();
?>