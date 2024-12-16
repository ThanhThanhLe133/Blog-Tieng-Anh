<?php
include "../conn.php";
$sql = "SELECT DISTINCT branch_name FROM users";
$result = $conn->query($sql);

$studySchool = "";
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $branchName = $row['branch_name'];
        $studySchool .= '<label><input type="checkbox" value="' . $branchName . '"> ' . $branchName . '</label><br>';
    }
}
echo $studySchool;
$conn->close();
?>