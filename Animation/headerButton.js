 //load button đăng nhập/đăng ký
 function loadData() {
        
    $.post("../../Animation/isLogin.php", {}, function (response) {
        $(".header__action").html(response);
    });
}
loadData();
$(document).ready(function () {
    $('.header__action').on('click', function () {
        if ($(this).children().first().hasClass('btn--logout')) {
            var result = confirm("Bạn có chắc chắn muốn thoát?");
        }
       
        if (result) {
            setTimeout(function () {
                window.location.href = "../../user/login/index.php";
            }, 500);
        }
    });
})