$(document).ready(function () {
    //load ds guest
    displayBlogData();
    $(".addBlog").on("click", function () {
        window.location.href = "../TaoBlog/index.php";
    })
    //đăng xuất
    $('.header__action').on('click', function (e) {
        if ($(this).children().first().hasClass('btn--logout')) {
            e.preventDefault();
            $("#custom-close .message").html("");
            $("#custom-close .message").html("Bạn có chắc chắn muốn đăng xuất");
            $("#custom-close").show();
            $(".btn-ok").on('click', function (e) {
                e.preventDefault();
                setTimeout(function () {
                    window.location.href = "../Login/index.php";
                }, 500);
            });
        }
    });

    function displayBlogData() {
        $.post("getData.php", {}, function (response) {
            $('#blog-table').append(response);
        }).fail(function () {
            alert("Có lỗi xảy ra, vui lòng thử lại.");
        });
    }
});
