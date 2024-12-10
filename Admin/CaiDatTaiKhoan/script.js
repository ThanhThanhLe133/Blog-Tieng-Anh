$(document).ready(function () {
    function loadData() {
        $.post("userdata.php", {}, function (response) {
            $("#user-info").html(response);
        }).fail(function () {
            $("#error").html(response);
        });

        $.post("../isLogin.php", {}, function (response) {
            $(".header__action").html(response);
        });
    }
    loadData();
   
    $("#btnSave").click(function (e) {
        e.preventDefault();
        let firstname = $("#firstname").val();
        let lastname = $("#lastname").val();
        let username = $("#username").val();
        let email = $("#email").val();
        console.log(firstname);

        $.post("updateAccount.php", {
            firstname: firstname,
            lastname: lastname,
            username: username,
            email: email
        }, function (response) {
            if (response.includes("thành công")) {
                $(".kq")
                    .removeClass("error")
                    .addClass("success")
                    .html(response);
                setTimeout(function () {
                    window.location.href = "../CaiDatTaiKhoan/index.html";
                }, 1000);
            } else {
                $(".kq")
                    .removeClass("success")
                    .addClass("error")
                    .html(response);
            }
        }).fail(function () {
            $(".kq")
                .removeClass("success")
                .addClass("error")
                .html("Có lỗi xảy ra, vui lòng thử lại.");
        });
    });
})