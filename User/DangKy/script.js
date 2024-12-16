$(document).ready(function () {

    //xoá enter với input
    $("input").keydown(function (event) {
        if (event.key === "Enter") {
            event.preventDefault();
        }
    });

    //click vào ô input -> xoá nội dung
    $("input").on('click', function () {
        if ($("#username").val() !== "" && $("#new-password").val() !== ""&& $("#confirm-password").val() !== "") {
            $(".kq").html("");
            $("#username").val("");
            $("#new-password").val("");
            $("#confirm-password").val("");
            $(".kq")
                .removeClass("success")
                .removeClass("error")
        }
    });

    //xử lý enter form -> handleLogin
    $("#registerForm").on('keydown', function (e) {
        if (e.keyCode === 13) {
            e.preventDefault();
            handleRegister();
        }
    });
    //xử lý nút register-> handleRegister
    $("#btnRegister").on('click', function (e) {
        e.preventDefault();
        handleRegister();
    });

    //bỏ qua enter với input
    $("input").keydown(function (event) {
        if (event.key === "Enter") {
            event.preventDefault();
        }
    });

    //hiển thị pass
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
    });

    function handleRegister() {
        let username = $("#username").val();
        let newPassword = $("#new-password").val();
        let confirmPassword = $("#confirm-password").val();

        if (username === "" || newPassword === "" || confirmPassword === "") {
            $(".kq")
                .removeClass("success")
                .addClass("error")
                .html("<p>Vui lòng nhập đầy đủ thông tin.</p>");
            return;
        }
        else if (newPassword !== confirmPassword) {
            $(".kq")
                .removeClass("success")
                .addClass("error")
                .html("Xác nhận mật khẩu không khớp!");
            return;
        }
        $.post("themtaikhoan.php", {
            username: username,
            password: newPassword
        }, function (response) {
            if (response.includes("success")) {
                $("#custom-alert").show();
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
        $(".btn-close").on('click', function (e) {
            e.preventDefault();
            setTimeout(function () {
                window.location.href = "../Login/index.php";
            }, 500);
        });
    }
})

