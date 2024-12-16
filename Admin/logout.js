$(document).ready(function () {
    //đăng xuất
    $('.header__action').on('click', function (e) {
        if ($(this).children().first().hasClass('btn--logout')) {
            e.preventDefault();
            $("#custom-close .message").text("Bạn có chắc chắn muốn đăng xuất");
            $("#custom-close").show();

            $(".btn-close").on("click", function (e) {
                e.preventDefault();
                $("#custom-close").hide();
            });

            $(".btn-ok").on('click', function (e) {
                e.preventDefault();
                setTimeout(function () {
                    window.location.href = "../Login/index.php";
                }, 500);
            });
        }
    });

})

