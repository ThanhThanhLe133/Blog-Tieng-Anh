<?php

session_start();

if (!isset($_SESSION['user_name'])) {
    echo "<script>
        alert('Vui lòng đăng nhập!');
        window.location.href = '../ login/index.php';
    </script>";
    exit;
}
include "../conn.php";
$sql = "SELECT id,firstName, lastName, phone, email, studySchool, birthYear,
              DATE_FORMAT(currentDate, '%d/%m/%Y') AS formattedDate
        FROM guest";

$result = $conn->query($sql);
$html="";
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $html .= "
        <tr data-id='{$row['id']}'>
            <td class='py-2 px-4 border-b border-gray-200 firstName'>{$row['firstName']}</td>
            <td class='py-2 px-4 border-b border-gray-200 lastName'>{$row['lastName']}</td>
            <td class='py-2 px-4 border-b border-gray-200 phone'>{$row['phone']}</td>
            <td class='py-2 px-4 border-b border-gray-200 email'>{$row['email']}</td>
            <td class='py-2 px-4 border-b border-gray-200 studySchool'>{$row['studySchool']}</td>
            <td class='py-2 px-4 border-b border-gray-200 birthYear'>{$row['birthYear']}</td>
            <td class='py-2 px-4 border-b border-gray-200 formattedDate'>{$row['formattedDate']}</td>
            <td class='py-2 px-4 border-b border-gray-200'>
                <button class='text-red-500 hover:text-red-700 deleteBtn'>
                    <i class='fas fa-trash'></i>
                </button>
            </td>
        </tr>";

    }
    echo $html;
}
$conn->close();
?>