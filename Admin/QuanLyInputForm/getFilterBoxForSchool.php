<?php
include "../conn.php";
$sql = "SELECT DISTINCT studySchool FROM guest";
$result = $conn->query($sql);

$studySchool="";
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $studySchool .= '<label><input type="checkbox" value="' . $row['studySchool'] . '"> ' . $row['studySchool'] . '</label><br>';
    }
}
echo $studySchool;
$conn->close();
?>