$(document).ready(function () {
    loadData();
    //load button đăng nhập/đăng ký
    function loadData() {
        $.post("../isLogin.php", {}, function (response) {
            $(".header__action").html(response);
        });
    }
});

