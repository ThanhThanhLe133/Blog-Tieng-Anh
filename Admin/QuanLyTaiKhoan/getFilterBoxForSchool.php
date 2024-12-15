<?php
include "../conn.php";
$sql = "SELECT DISTINCT branch_name FROM users";
$result = $conn->query($sql);

$studySchool="";
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $studySchool .= '<label><input type="checkbox" value="' . $row['branch_name'] . '"> ' . $row['branch_name'] . '</label><br>';
    }
}
echo $studySchool;
$conn->close();
?>