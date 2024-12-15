<?php
include "../conn.php";
$sql = "SELECT DISTINCT l_name FROM users";
$result = $conn->query($sql);
$lastName="";
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $lastName .= '<label><input type="checkbox" value="' . $row['l_name'] . '"> ' . $row['l_name'] . '</label><br>';
    }
}

echo $lastName;
$conn->close();
?>