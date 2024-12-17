$(document).ready(function () {
    //click vào input -> xoá
    $("#new-password, #confirm-password").on('click', function () {
        $(".kq").html("");
        $("#new-password").val("");
        $("#confirm-password").val("");
        $(".kq")
            .removeClass("success")
            .removeClass("error")
    });

    //bỏ qua enter với input
    $("input").keydown(function (event) {
        if (event.key === "Enter") {
            event.preventDefault();
        }
    });

    //sự kiện enter tới form -> handleUpdatePass
    $("#changePassForm").on('keydown', function (e) {
        if (e.keyCode === 13) {
            e.preventDefault();
            handleUpdatePass();
        }
    });

    //sự kiện nhấn nút thay đổi pass-> handleUpdatePass
    $("#updatePass").on('click', function (e) {
        e.preventDefault();
        handleUpdatePass();
    });
    function handleUpdatePass() {
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
    }

    //nút ẩn hiện pass
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
    $(".showpass").on("mousedown", function (e) {
        e.preventDefault();
        let pass = $(this).siblings("input");
        let icon = $(this).find("img");
        pass.attr("type", "text"); 
        icon.attr("src", "../../Images/eye.png")
    });
    
    $(".showpass").on("mouseup mouseleave", function (e) {
        e.preventDefault();
        let pass = $(this).siblings("input");
        let icon = $(this).find("img");
        pass.attr("type", "password");
        icon.attr("src", "../../Images/eye_close.png");
    })
    //nếu chưa đăng nhập -> ngăn chặn mở menu
    var targetLink = "";
    $(".nav__item").on("click", function (e) {
        e.preventDefault();
        targetLink = $(this).children().attr("href");
        $.post("../isLoginMenu.php", {}, function (response) {
            if (response.includes("true")) {
                window.location.href = targetLink;
            } else {
                $("#custom-alert").show();
            }
        }).fail(function () {
            $(".message").text("Có lỗi xảy ra, vui lòng thử lại sau!");
            $("#custom-alert").show();
        });
    })

    $(".btn-close").on("click", function (e) {
        e.preventDefault();
        $("#custom-alert").hide();
    });

});