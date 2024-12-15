<!DOCTYPE html>
<html>

<head>
    <title>Thêm mới blog</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- reset css -->
    <link rel="stylesheet" href="../../Styles/reset.css">
    <!-- styles -->

    <link rel="stylesheet" href="../../Styles/general-styles.css">
    <link rel="stylesheet" href="../../Styles/header.css">
    <link rel="stylesheet" href="../../Styles/footer.css">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="animation.css">
    <link rel="stylesheet" href="../../Styles/animation-general.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&amp;display=swap" rel="stylesheet">
    <link
        href="https://fonts.googleapis.com/css2?family=Bodoni+Moda:ital,opsz,wght@0,6..96,400..900;1,6..96,400..900&family=Carattere&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap"
        rel="stylesheet">
    <script src="//cdn.quilljs.com/1.3.6/quill.js"></script>
    <link href="//cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
    <link href="//cdn.quilljs.com/1.3.6/quill.bubble.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
</head>

<body>
	<?php
// Khởi tạo biến với giá trị mặc định
$alert = '';
$message = '';

// Kiểm tra nếu có tham số trong URL
if (isset($_GET['alert'])) {
    $alert = $_GET['alert'];
}

if (isset($_GET['message'])) {
    $message = $_GET['message'];
}
?>

    <div id="custom-alert">
        <div class="message"></div>
    </div>

    <?php if ($alert && $message): ?>
        <script>
            $(document).ready(function () {
                $("#custom-alert .message").text("<?php echo htmlspecialchars($message); ?>");
                $("#custom-alert").addClass("<?php echo $alert === 'success' ? 'alert-success' : 'alert-error'; ?>");
                $("#custom-alert").fadeIn();

                setTimeout(function () {
                    $("#custom-alert").fadeOut();
                }, 3000);
            });
        </script>
    <?php endif; ?>
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
                                <a class="nav__link" href="../QuanLyTaiKhoan/index.html">
                                    <p class="nav__text">QUẢN LÝ TÀI KHOẢN</p>
                                </a>
                            </li>
                            <li class="nav__item">
                                <a class="nav__link" href="../CaiDatTaiKhoan/index.php">
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

    <!-- main -->
    <main>
        <div class="container mx-auto mt-8">
            <div class="flex">
                <div class="w-3/4 bg-white p-8 ml-8 shadow-lg">
                    <h1 class="text-2xl font-bold mb-4">Thêm mới blog</h1>
                    <form action="submitblog.php" method="POST" enctype="multipart/form-data">
                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2" for="category">Loại blog</label>
                            <select id="category" name="category">
                                <option value="Tiếng anh trẻ em">Tiếng anh trẻ em</option>
                                <option value="Tin tức - Sự kiện">Tin tức - Sự kiện</option>
                                <option value="Nuôi dạy con">Nuôi dạy con</option>
                            </select>
                        </div>
                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2" for="title">Tiêu đề</label>
                            <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="title" name="title" placeholder="Nhập tiêu đề của blog" type="text">
                        </div>
                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2" for="content">Nội dung</label>
                            <div id="editor" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline ql-container ql-snow" style="height: 300px;">
                                <div class="ql-editor ql-blank" data-gramm="false" contenteditable="true"><p><br></p></div>
                            </div>
                            <input type="hidden" name="content" id="content">
                        </div>
                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2" for="image">Hình ảnh tiêu đề</label>
                            <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="image" name="image" type="file">
                        </div>
                        <button type="submit" class="bg-gray-800 text-white py-2 px-4 rounded hover:bg-gray-700">Lưu</button>
                    </form>
                </div>
            </div>
        </div>
	<div id="custom-alert">
    	    <div class="message">
                Vui lòng đăng nhập trước!
            </div>
            <button class="btn-close">Đóng</button>
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
   

</body>


</html>