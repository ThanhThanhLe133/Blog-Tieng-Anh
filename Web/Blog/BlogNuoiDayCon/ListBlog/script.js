$(document).ready(function () {
    var urlParams = new URLSearchParams(window.location.search);
    var page = urlParams.get('page') ? parseInt(urlParams.get('page')) : 1;

    displayBlogList(page);
    displayLatestBlog();
    seperatePage(page);
    function displayBlogList(page) {
        $.post("load_blog.php", { page: page }, function (response) {
            $('#articles').empty().append(response); 
        }).fail(function () {
            alert("Có lỗi xảy ra, vui lòng thử lại.");
        });
    }
    function displayLatestBlog() {
        $.post("../load_latest_blog.php", {}, function (response) {
            $('#latestBlog').append(response);
        }).fail(function () {
            alert("Có lỗi xảy ra, vui lòng thử lại.");
        });
    }
    function seperatePage(page) {
        $.post("seperate_page.php", { page: page }, function (response) {
            $('#navigationPage').append(response);
            $('#navigationPage li').each(function() {
                $(this).removeClass('current');
            });
            $('#page' + page).addClass('current');
        }).fail(function () {
            alert("Có lỗi xảy ra, vui lòng thử lại.");
        });
    }
});
