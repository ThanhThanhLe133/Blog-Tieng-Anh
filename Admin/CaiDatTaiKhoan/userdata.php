<?php

session_start();

if (!isset($_SESSION['user_id'])) {
    echo "Chưa đăng nhập.";
    exit;
}

$servername = "localhost";
$username = "root";
$password = "";
$DBName = "BLOGTIENGANH";

$conn = mysqli_connect($servername, $username, $password, $DBName)
    or die("<p>Không thể connect</p>" . "<p>Error code: " . mysqli_connect_error() . ": " . mysqli_connect_error() . "</p>");

mysqli_set_charset($conn, "utf8");

$user_id = $_SESSION['user_id'];

$stmt = $conn->prepare("SELECT first_name, last_name, username, email FROM admin WHERE username = ?");
$stmt->bind_param("s", $user_id);
$stmt->execute();
$result = $stmt->get_result();
// Kiểm tra kết quả
if ($result && mysqli_num_rows($result) > 0) {
    $user = mysqli_fetch_assoc($result);

    echo '<div class="mb-4">
        <label class="block text-gray-700 text-sm font-bold mb-2" for="firstname">Firstname (Họ và tên đệm)</label>
        <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
               id="firstname" name="firstname" placeholder="Firstname" type="text"
               value="' . htmlspecialchars($user['first_name']) . '" required>
    </div>

    <div class="mb-4">
        <label class="block text-gray-700 text-sm font-bold mb-2" for="lastname">Lastname (Tên)</label>
        <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
               id="lastname" name="lastname" placeholder="Lastname" type="text"
               value="' . htmlspecialchars($user['last_name']) . '" required>
    </div>

    <div class="mb-4">
        <label class="block text-gray-700 text-sm font-bold mb-2" for="username">Username</label>
        <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
               id="username" name="username" placeholder="Username" type="text"
               value="' . htmlspecialchars($user['username']) . '" required>
    </div>

    <div class="mb-4">
        <label class="block text-gray-700 text-sm font-bold mb-2" for="email">Email</label>
        <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
               id="email" name="email" placeholder="Email" type="email"
               value="' . htmlspecialchars($user['email']) . '" required>
    </div>';
} else {
    echo "Không tìm thấy dữ liệu người dùng.";
}
$stmt->close();
mysqli_close($conn);
?>