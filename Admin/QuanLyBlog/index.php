<!DOCTYPE html>
<html>

<head>
    <title>Quản lý tài khoản</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- reset css -->
    <link rel="stylesheet" href="../../Styles/reset.css">
    <!-- styles -->

    <link rel="stylesheet" href="../../Styles/general-styles.css">
    <link rel="stylesheet" href="../../Styles/header.css">
    <link rel="stylesheet" href="../../Styles/footer.css">
    <link rel="stylesheet" href="style.css">
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

    <!-- header -->
    <header>
        <div class="main-container">
            <div class="main-container__top-header">
                <div class="top-header__phone-number">
                    <a class="phone-number__link" href="tel:18006175">1800 6175</a>
                </div>
                <div class="top-header__language">
                    <div class="language vietnamese">
                        <div class="language__flag">
                            <img src="../../Images/vn flag.png" alt="VN flag" />
                        </div>
                        <span class="language__text">TIẾNG VIỆT</span>
                        <div class="language__icon"><img src="../../Images/chevron-down.png" alt="" /></div>
                    </div>
                    <div class="language english">
                        <div class="language__flag">
                            <img src="../../Images/us flag.png" alt="US flag" />
                        </div>
                        <span class="language__text">ENGLISH</span>
                        <div class="language__icon"><img src="../../Images/chevron-down.png" alt="" /></div>
                    </div>
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
                                <a class="nav__link" href="../QuanLyInputForm/index.php">
                                    <p class="nav__text">QUẢN LÝ THÔNG TIN FORM</p>
                                </a>
                            </li>

                            <li class="nav__item">
                                <a class="nav__link" href="../TaoBlog/index.php">
                                    <p class="nav__text">THÊM MỚI BLOG</p>
                                </a>
                            </li>

                            <li class="nav__item">
                                <a class="nav__link" href="../QuanLyBlog/index.php">
                                    <p class="nav__text">QUẢN LÝ BLOG</p>
                                </a>
                            </li>
                            <li class="nav__item">
                                <a class="nav__link" href="../QuanLyTaiKhoan/index.php">
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
                      
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!-- main -->
    <main>
        <div class="mb-4 functionBtn">
            <input type="text" id="search-input" class="w-full px-4 py-2 border rounded-lg"
                placeholder="Tìm kiếm theo tiêu đề, tác giả, thể loại..." />
            <div class="filterButton">
                <button id="filterButton" class="text-green-500 hover:text-green-700">
                    <i class="fas fa-filter"></i> Lọc
                </button>
                <div id="filterBox">
                    <div>
                        <label for="filterAuthor">Author:</label>
                        <div id="authorCheckboxes"></div>
                    </div>
                    <div>
                        <label for="filterCreatedDate">Created Date:</label>
                        <div id="CreatedDateCheckboxes"></div>
                    </div>
                    <div>
                        <label for="filterUpdatedDate">Updated Date:</label>
                        <div id="UpdatedDateCheckboxes"></div>
                    </div>
                    <div>
                        <label for="filterCategory">Category:</label>
                        <div id="CategoryCheckboxes">
                            <label><input type="checkbox" value="Tiếng anh trẻ em"> Tiếng anh trẻ em</label><br>
                            <label><input type="checkbox" value="Tin tức - Sự kiện"> Tin tức - Sự kiện</label><br>
                            <label><input type="checkbox" value="Nuôi dạy con"> Nuôi dạy con</label><br>
                        </div>
                    </div>
                    <div>
                        <button id="applyFilter" class="text-blue-500">Áp dụng</button>
                        <button id="closeFilter" class="text-red-500">Đóng</button>
                    </div>

                </div>
            </div>
            <div class="sort-container">
                <button id="sortButton" class="text-blue-500 hover:text-blue-700">
                    <i class="fas fa-sort"></i> Sắp xếp
                </button>
                <div id="sortBox" class="mt-2">
                    <select id="sortSelect" class="border rounded py-1 px-2">
                        <option value="">-- Chọn cách sắp xếp --</option>
                        <option value="author">Author</option>
                        <option value="created_at">Created Date</option>
                        <option value="updated_at">Updated Date</option>
                        <option value="category">Category</option>
                        <option value="title_blog">Title</option>
                    </select>
                    <div>
                        <button id="applySortAZ" class="text-blue-500">A-Z</button>
                        <button id="applySortZA" class="text-blue-500">Z-A</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="mx-auto p-6 bg-white shadow-md rounded-lg mt-10 blogForm">
            <div class=" mb-6">
                <h1 class="text-2xl font-semibold">Quản lý Blog</h1>
            </div>
            <button class="bg-gray-800 text-white py-2 px-4 rounded hover:bg-gray-700 addBlog">Thêm Blog</button>
            <table class="min-w-full bg-white ">
                <thead>
                    <tr>
                        <th
                            class="py-2 px-4 border-b border-gray-200 bg-gray-100 text-left text-sm font-semibold text-gray-600">
                            Title</th>
                        <th
                            class="py-2 px-4 border-b border-gray-200 bg-gray-100 text-left text-sm font-semibold text-gray-600">
                            Author</th>
                        <th
                            class="py-2 px-4 border-b border-gray-200 bg-gray-100 text-left text-sm font-semibold text-gray-600">
                            Created At</th>
                        <th
                            class="py-2 px-4 border-b border-gray-200 bg-gray-100 text-left text-sm font-semibold text-gray-600">
                            Updated At</th>
                        <th
                            class="py-2 px-4 border-b border-gray-200 bg-gray-100 text-left text-sm font-semibold text-gray-600">
                            Category</th>
                        <th
                            class="py-2 px-4 border-b border-gray-200 bg-gray-100 text-left text-sm font-semibold text-gray-600">
                            Actions</th>
                    </tr>
                </thead>
                <tbody id="blog-table">

                </tbody>
            </table>
        </div>
        <div id="custom-alert">
            <div class="message">
                Đã xoá thành công!
            </div>
            <button class="btn-close">Đóng</button>
        </div>
        <div id="custom-close">
            <div class="message">
            </div>
            <div>
                <button class="btn-ok">Ok</button>
                <button class="btn-close">Đóng</button>
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
                            <li class="footer__link-item"><a href="../../Các cơ sở/index.html"
                                    class="footer__link">Nguyễn
                                    Thị Thập</a></li>
                            <li class="footer__link-item"><a href="../../Các cơ sở/index.html"
                                    class="footer__link">Cityland Park Hills</a></li>
                            <li class="footer__link-item"><a href="../../Các cơ sở/index.html" class="footer__link">Cao
                                    Đức
                                    Lân</a></li>
                            <li class="footer__link-item"><a href="../../Các cơ sở/index.html" class="footer__link">Sư
                                    Vạn
                                    Hạnh</a></li>
                            <li class="footer__link-item"><a href="../../Các cơ sở/index.html" class="footer__link">Lê
                                    Văn
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
    <script src="../loadHeader.js"></script>
    <script src="../preventAccess.js"></script>
    <script src="../logout.js"></script>
</body>

</html>