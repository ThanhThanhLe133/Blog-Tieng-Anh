$(document).ready(function () {
    $("#new-password", "#confirm-password").click(function (e) {
        $(".kq").html("");
        $(".send").removeClass("error success");
    });
    $("#updatePass").click(function (e) {
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
            return;
        }
        
        else if (newPassword !== confirmPassword) {
            $(".kq")
                .removeClass("success")
                .addClass("error")
                .html("Xác nhận mật khẩu không khớp!");
            return;
        }

        $.post("changePassword.php", {
            newPassword: newPassword
        }, function (response) {
            if (response.includes("thành công")) {
                $(".kq")
                    .removeClass("error")
                    .addClass("success")
                    .html(response);
                    setTimeout(function () {
                        window.location.href = "../Login/index.html";
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
    });
});