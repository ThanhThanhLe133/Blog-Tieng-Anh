$(document).ready(function () {
    function loadData() {
        $.post("../isLogin.php", {}, function (response) {
            $(".header__action").html(response);
        });
    }
    loadData();
    $("#new-password, #confirm-password").on('input', function () {
        $(".kq").html("");
    });

    $("#updatePass").on('click', function (e) {
        e.preventDefault(); 
        let newPassword = $("#new-password").val();
        let confirmPassword = $("#confirm-password").val();
        console.log(newPassword);
        console.log(confirmPassword);

        if (newPassword === "" || confirmPassword === "") {
            $(".kq")
                .removeClass("success")
                .addClass("error")
                .html("Vui lòng nhập đầy đủ thông tin.");
        }
        else if (newPassword !== confirmPassword) {
            $(".kq")
                .removeClass("success")
                .addClass("error")
                .html("Xác nhận mật khẩu không khớp!");
        }
        else {
            $.post("changePassword.php", {
                newPassword: newPassword
            }, function (response) {
                if (response.includes("thành công")) {
                    $(".kq")
                        .removeClass("error")
                        .addClass("success")
                        .html(response);
                    setTimeout(function () {
                        window.location.href = "../Login/index.php";
                    }, 500);
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
    });

    $(".showpass").on("click", function (e) {
        e.preventDefault();
        let pass = $(this).siblings("input");
        let icon = $(this).find("img");
        if (pass.attr("type") === "password") {
            pass.attr("type", "text");
            icon.attr("src", "../../Images/eye.png");
        }
        else {
            pass.attr("type", "password");
            icon.attr("src", "../../Images/eye_close.png");
        }
    })

    $('.header__action').on('click', function () {
        if ($this.first - child.text != "ĐĂNG XUẤT")
            return;
        var result = confirm("Bạn có chắc chắn muốn thoát?");

        if (result) {
            setTimeout(function () {
                window.location.href = "../Login/index.php";
            }, 500);
        }
    });
});