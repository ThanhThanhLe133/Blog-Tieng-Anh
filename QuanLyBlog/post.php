<?php
// Include database connection
require_once '../conn.php';

// Fetch blog data including category details
$sql = "SELECT 
            blogs.blog_id, 
            blogs.title, 
            blogs.created_at, 
            blogs.content, 
            categories.category_name
        FROM blogs
        LEFT JOIN categories ON blogs.category_id = categories.category_id;";

// Thực thi câu truy vấn
$result = $conn->query($sql);

// Kiểm tra nếu có thông báo từ URL
if (isset($_GET['alert']) && isset($_GET['message'])) {
    $alert = $_GET['alert'];
    $message = urldecode($_GET['message']);
    if ($alert == 'success') {
        echo "<script>alert('Thành công: $message');</script>";
    } else if ($alert == 'error') {
        echo "<script>alert('Lỗi: $message');</script>";
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog Management</title>

    <!-- External Styles and Fonts -->
    <link rel="stylesheet" href="../../Styles/reset.css">
    <link rel="stylesheet" href="../../Styles/general-styles.css">
    <link rel="stylesheet" href="../../Styles/header.css">
    <link rel="stylesheet" href="../../Styles/footer.css">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="animation.css">
    <link rel="stylesheet" href="../../Styles/animation-general.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
</head>

<body>
    <!-- header -->
    <header>
        <div class="main-container">
            <div class="main-container__top-header">
                <div class="top-header__phone-number">
                    <a class="phone-number__link" href="tel:18006175">1800 6175</a>
                </div>
                <div class="top-header__language">
                    <div class="language__flag">
                        <img src="../../Images/vn flag.png" alt="VN flag" />
                    </div>
                    <span class="language__text">TIẾNG VIỆT</span>
                    <div class="language__icon"><img src="../../Images/chevron-down.png" alt="" /></div>
                </div>
            </div>
            <div class="main-container__header--fixed">
                <div class="header__body">
                    <!-- logo -->
                    <img src="../../Images/kids and us.png" alt="" class="logo" />

                    <!-- nav -->
                    <nav class="header__nav">
                        <ul class="nav__list">
                            <li class="nav__item">
                                <a class="nav__link" href="../../HomePage/index.html">
                                    <p class="nav__text">QUẢN LÝ THÔNG TIN FORM</p>
                                </a>
                            </li>

                            <li class="nav__item">
                                <a class="nav__link" href="../../PP của chúng tôi/index.html">
                                    <p class="nav__text">THÊM MỚI BLOG</p>
                                </a>
                            </li>

                            <li class="nav__item">
                                <a class="nav__link" href="#">
                                    <span class="link-before">
                                        <p class="nav__text">QUẢN LÝ BLOG &#x23F7</p>
                                    </span>
                                </a>
                                <ul class="nav__submenu blog">
                                    <li class="submenu__item children_English"><a class="submenu__link" href="#">Tiếng
                                            Anh trẻ em</a></li>
                                    <li class="submenu__item raise-children"><a class="submenu__link" href="#">Nuôi dạy
                                            con</a></li>
                                    <li class="submenu__item news"><a class="submenu__link" href="#">Tin tức - Sự
                                            kiện</a></li>
                                </ul>
                            </li>
                            <li class="nav__item">
                                <a class="nav__link" href="../../PP của chúng tôi/index.html">
                                    <p class="nav__text">QUẢN LÝ TÀI KHOẢN</p>
                                </a>
                            </li>
                            <li class="nav__item">
                                <a class="nav__link" href="../../PP của chúng tôi/index.html">
                                    <p class="nav__text">CÀI ĐẶT</p>
                                </a>
                            </li>
                        </ul>
                    </nav>
                    <!-- btn action -->
                    <div class="header__action">
                        <a href="../../Đăng ký/index.html" class="btn btn--logout">ĐĂNG XUẤT</a>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <!-- Main Content -->
<!-- Main Content -->
<main>
    <div class="w-3/4 bg-white p-8 ml-8 shadow-lg">
        <h2 class="text-2xl font-bold mb-4">Quản lý Blog</h2>
        <a href="add_blog.php" class="btn btn--add bg-gray-800 text-white py-2 px-4 rounded hover:bg-gray-700 mb-4 inline-block">Thêm Blog</a>
        <div class="mb-4">
            <table class="table min-w-full bg-white">
                <thead>
                    <tr>
                        <th class="py-2 px-4 border-b border-gray-200 bg-gray-100 text-left text-sm font-semibold text-gray-700">ID</th>
                        <th class="py-2 px-4 border-b border-gray-200 bg-gray-100 text-left text-sm font-semibold text-gray-700">Title</th>
                        <th class="py-2 px-4 border-b border-gray-200 bg-gray-100 text-left text-sm font-semibold text-gray-700">Category</th>
                        <th class="py-2 px-4 border-b border-gray-200 bg-gray-100 text-left text-sm font-semibold text-gray-700">Created At</th>
                        <th class="py-2 px-4 border-b border-gray-200 bg-gray-100 text-left text-sm font-semibold text-gray-700">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if ($result && $result->num_rows > 0): ?>
                        <?php while ($row = $result->fetch_assoc()): ?>
                            <tr>
                                <td class="py-2 px-4 border-b border-gray-200"><?php echo $row['blog_id']; ?></td>
                                <td class="py-2 px-4 border-b border-gray-200"><?php echo htmlspecialchars($row['title']); ?></td>
                                <td class="py-2 px-4 border-b border-gray-200"><?php echo htmlspecialchars($row['category_name']); ?></td>
                                <td class="py-2 px-4 border-b border-gray-200"><?php echo $row['created_at']; ?></td>
                                <td class="py-2 px-4 border-b border-gray-200">
                                    <div class="flex space-x-2">
                                        <a href="edit_blog.php?id=<?php echo $row['blog_id']; ?>" class="btn btn--edit bg-blue-500 text-white py-1 px-3 rounded hover:bg-blue-700 text-xs w-auto">Edit</a>
                                        <form action="delete_blog.php" method="post" class="inline-block form--inline">
                                            <input type="hidden" name="id" value="<?php echo $row['blog_id']; ?>">
                                            <button type="submit" class="btn btn--delete bg-red-500 text-white py-1 px-3 rounded hover:bg-red-700 text-xs w-auto" onclick="return confirm('Bạn chắc chắn muốn xóa bài viết?');">Delete</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="6" class="py-2 px-4 text-center text-gray-500">No blogs found</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</main>
   
    <!-- footer -->
    <footer>
        <div class="footer__body">
            <div class="footer__grid">
                <div class="footer__item">
                    <h4 class="footer__title">KIDS&amp;US VIETNAM</h4>
                    <div class="footer__content">
                        <ul class="footer__links">
                            <li class="footer__link-item"><a href="../../General Terms Condition/index.html"
                                    class="footer__link">General Terms &amp;
                                    Condition</a></li>
                            <li class="footer__link-item"><a href="../../Rules Regulations/index.html"
                                    class="footer__link">Rules &amp; Regulations</a>
                            </li>
                            <li class="footer__link-item"><a href="../../Privacy Policy/index.html"
                                    class="footer__link">Privacy Policy</a></li>
                            <li class="footer__link-item"><a href="#" class="footer__link">Licenses</a></li>
                        </ul>
                    </div>
                </div>
                <div class="footer__item">
                    <h4 class="footer__title">CÁC KHOÁ HỌC</h4>
                    <div class="footer__content">
                        <ul class="footer__links">
                            <li class="footer__link-item"><a href="../../1-2/index.html" class="footer__link">Khoá học
                                    tiếng Anh cho trẻ
                                    1-2 tuổi</a></li>
                            <li class="footer__link-item"><a href="../../3-8/index.html" class="footer__link">Khoá học
                                    tiếng Anh cho trẻ
                                    3-8 tuổi</a></li>
                            <li class="footer__link-item"><a href="../../9-12/index.html" class="footer__link">Khoá học
                                    tiếng Anh cho trẻ
                                    9-12 tuổi</a></li>
                            <li class="footer__link-item"><a href="../../13-18/index.html" class="footer__link">Khoá học
                                    tiếng Anh cho trẻ
                                    13-18 tuổi</a></li>
                        </ul>
                    </div>
                </div>
                <div class="footer__item">
                    <h4 class="footer__title">CƠ SỞ</h4>
                    <div class="footer__content">
                        <ul class="footer-links">
                            <li class="footer__link-item"><a href="../../Các cơ sở/index.html" class="footer__link">Nguyễn
                                    Thị Thập</a></li>
                            <li class="footer__link-item"><a href="../../Các cơ sở/index.html"
                                    class="footer__link">Cityland Park Hills</a></li>
                            <li class="footer__link-item"><a href="../../Các cơ sở/index.html" class="footer__link">Cao Đức
                                    Lân</a></li>
                            <li class="footer__link-item"><a href="../../Các cơ sở/index.html" class="footer__link">Sư Vạn
                                    Hạnh</a></li>
                            <li class="footer__link-item"><a href="../../Các cơ sở/index.html" class="footer__link">Lê Văn
                                    Việt</a></li>
                            <li class="footer__link-item"><a href="../../Các cơ sở/index.html" class="footer__link">Tên
                                    Lửa</a></li>
                        </ul>
                    </div>
                </div>
                <div class="footer__item">
                    <h4 class="footer__title">LIÊN HỆ VỚI CHÚNG TÔI</h4>
                    <div class="footer__content">
                        <ul class="footer__contacts">
                            <li class="footer__contact footer__contact--location"> 47-49 Nguyễn Thị Thập, Khu dân cư Him
                                Lam, Quận 7,
                                TP.HCM</li>
                            <li class="footer__contact footer__contact--email"> info@kidsandus.net.vn</li>
                            <li class="footer__contact footer__contact--phone">1800 6175</li>
                        </ul>
                    </div>
                    <div class="footer__social">
                        <ul class="footer__social-icons">
                            <li class="footer__social-item">
                                <a class="footer__social-link--facebook" target="_blank"
                                    href="https://www.facebook.com/kidsandus.vn">
                                    <img src="../../Images/facebook.png">
                                </a>
                            </li>
                            <li class="footer__social-item">
                                <a class="footer__social-link--youtube" target="_blank"
                                    href="https://www.youtube.com/channel/UCP7ErLtSVIywSh5Qdgm2AMw">
                                    <img src="../../Images/youtube.png">
                                </a>
                            </li>
                            <li class="footer__social-item">
                                <a class="footer__social-link--instagram" target="_blank"
                                    href="https://www.instagram.com/kidsandus.vn/">
                                    <img src="../../Images/insta.png">
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="footer__info">
            <div class="footer__copyright">
                <p class="footer__text">Copyright © 2024 Kids&amp;Us Vietnam</p>
            </div>
        </div>
    </footer>

    <script src="script.js"></script>
    <script src="../../Animation/load-effect.js"></script>
    <?php
// Đóng kết nối
$conn->close();
?>
</body>

</html>
