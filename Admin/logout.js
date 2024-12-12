$(document).ready(function () {
    $('.header__action').on('click', function () {
        var result = confirm("Bạn có chắc chắn muốn thoát?");

        if (result) {
            setTimeout(function () {
                window.location.href = "../Login/index.php";
            }, 500);
        }
    });
})

