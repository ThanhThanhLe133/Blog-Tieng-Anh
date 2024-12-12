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

    $("#btnSave").on('click', function (e) {
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
                    window.location.href = "../CaiDatTaiKhoan/index.php";
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
    
    $('.header__action').on('click', function () {
        var result = confirm("Bạn có chắc chắn muốn thoát?");

        if (result) {
            setTimeout(function () {
                window.location.href = "../Login/index.php";
            }, 500);
        }
    });
})