$(document).ready(function () {
    loadData();
    preventAccess();
    function preventAccess() {
        $.post("../preventAccess.php", {}, function (response) {
            if (response === "No") {
                alert("Bạn chưa đăng nhập. Vui lòng đăng nhập trước khi tiếp tục.");
                window.location.href = "../Login/index.php";
            }
        }).fail(function () {
            alert("Có lỗi xảy ra khi kết nối tới server.");
        });
    }

    //load button đăng nhập/đăng ký
    function loadData() {
        $.post("../isLogin.php", {}, function (response) {
            $(".header__action").html(response);
        });
    }
});