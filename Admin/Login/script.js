$(document).ready(function () {
    $(".nav__link").click(function(){
        alert("Vui lòng đăng nhập")
    })
    $("#btnLogin").click(function () {
        let username = $("#username").val();
        let password = $("#password").val();
        console.log("username"+"password");

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
                        window.location.href = "../CaiDatTaiKhoan/index.html";
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