$(document).ready(function () {

    //xoá enter với input
    $("input").keydown(function (event) {
        if (event.key === "Enter") {
            event.preventDefault();
        }
    });

    //click vào ô input -> xoá nội dung
    $("input").on('click', function () {
        if ($("#username").val() !== "" && $("#password").val() !== "") {
            $(".kq").html("");
            $("#username").val("");
            $("#password").val("");
            $(".kq")
                .removeClass("success")
                .removeClass("error")
        }
    });

    //xử lý enter form -> handleLogin
    $("#loginForm").on('keydown', function (e) {
        if (e.keyCode === 13) {
            e.preventDefault();
            handleLogin();
        }
    });
    //xử lý nút login-> handleLogin
    $("#btnLogin").on('click', function (e) {
        e.preventDefault();
        handleLogin();
    });

    //chưa login -> ko vào đc menu
    $(".nav__item").on("click", function (e) {
        e.preventDefault();
        $("#custom-alert").show();
    });

    $(".btn-close").on("click", function (e) {
        e.preventDefault();
        $("#custom-alert").hide();
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

    function handleLogin() {
        let username = $("#username").val();
        let password = $("#password").val();

        if (username === "" || password === "") {
            $(".kq")
                .removeClass("success")
                .addClass("error")
                .html("<p>Vui lòng nhập đầy đủ thông tin.</p>");
            return;
        }

        $.post("login.php", {
            name: username,
            pass: password
        }, function (response) {
            if (response.includes("Chúc mừng")) {
                $(".kq")
                    .removeClass("error")
                    .addClass("success")
                    .html(response);
                setTimeout(function () {
                    window.location.href = "../CaiDatTaiKhoan/index.php";
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
})

