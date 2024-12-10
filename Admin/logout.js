$(document).ready(function () {
    $('.header__action').click(function (e) {
        var result = confirm("Bạn có chắc chắn muốn thoát?");
        if (result) {
            window.location.href = "";
        }
    });
})

