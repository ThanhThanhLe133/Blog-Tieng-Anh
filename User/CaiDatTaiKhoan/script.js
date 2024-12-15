$(document).ready(function () {
    //load button đăng nhập/đăng ký +user info
    function loadData() {
        $.post("userdata.php", {}, function (response) {
            $("#user-info").html(response);
        }).fail(function () {
            $("#error").html(response);
            $("#btnSave").hide();
            $(".changePass").hide();
        });

        $.post("../isLogin.php", {}, function (response) {
            $(".header__action").html(response);
        });
    }

    loadData();

    //sự kiện enter tới form -> handleUpdateSettings
    $("#settingForm").on('keydown', function (e) {
        if (e.keyCode === 13) {
            e.preventDefault();
            handleUpdateSettings();
        }
    });

    //sự kiện ấn nút lưu -> handleUpdateSettings
    $("#btnSave").on('click', function (e) {
        e.preventDefault();
        handleUpdateSettings();
    });
    function handleUpdateSettings() {
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
    }

    //nhấn đăng xuất
    $('.header__action').on('click', function (e) {
        e.preventDefault();
        $("#custom-close").show();

    });
    $(".btn-ok").on('click', function (e) {
        e.preventDefault();
        setTimeout(function () {
            window.location.href = "../Login/index.php";
        }, 500);
    });
    $(".btn-close").on('click', function (e) {
        e.preventDefault();
        $("#custom-alert").hide();
    });
})
