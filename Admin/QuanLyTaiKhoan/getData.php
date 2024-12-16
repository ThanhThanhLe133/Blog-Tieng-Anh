<?php

session_start();

if (!isset($_SESSION['user_name'])) {
    echo "<script>
        alert('Vui lòng đăng nhập!');
        window.location.href = '../login/index.php';
    </script>";
    exit;
}
include "../conn.php";
$sql = "SELECT * FROM users";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $html = "";
    while ($row = $result->fetch_assoc()) {
        $approval_status = $row['approval_status'] == 1 ? 'Approved' : 'Pending';
        $html .= "
        <tr data-users_id='{$row['users_id']}'>
            <td class='py-2 px-4 border-b border-gray-200 firstName'>{$row['f_name']}</td>
            <td class='py-2 px-4 border-b border-gray-200 lastName'>{$row['l_name']}</td>
            <td class='py-2 px-4 border-b border-gray-200 phone'>{$row['phone_number']}</td>
            <td class='py-2 px-4 border-b border-gray-200 email'>{$row['email']}</td>
            <td class='py-2 px-4 border-b border-gray-200 studySchool'>{$row['branch_name']}</td>
            <td class='py-2 px-4 border-b border-gray-200 birthYear'>{$row['birth_year']}</td>
                <td class='py-2 px-4 border-b border-gray-200 username'>{$row['username']}</td>
            <td class='py-2 px-4 border-b border-gray-200 password'>{$row['password']}</td>
            <td class='py-2 px-4 border-b border-gray-200 created_at'>{$row['created_at']}</td>
           <td class='py-2 px-4 border-b border-gray-200 approval_status'>{$approval_status}</td>
            <td class='py-2 px-4 border-b border-gray-200'>
                <button class='text-red-500 hover:text-red-700 deleteBtn'>
                    <i class='fas fa-trash'></i>
                </button>";

        if ($row['approval_status'] == 0) {
            $html .= "
                <button class='text-yellow-500 hover:text-yellow-700 approveBtn relative group'>
                <i class='fas fa-paper-plane'></i>
            </button>";
        }
        $html .= "</td></tr>";
    }
}
echo $html;
$conn->close();
?>