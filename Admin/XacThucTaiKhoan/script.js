$(document).ready(function () {

    //click email -> xoá OTP + email + thông báo
    $('#email').on("click", function (e) {
        e.preventDefault();
        $(".send").html("");
        $(".send").removeClass("error success");
        $("#verification-code").val("");
        $("#email").val("");
    });

    //chưa đăng nhập -> ko vào đc menu
    $(".nav__item").on("click", function (e) {
        e.preventDefault();
        $("#custom-alert").show();
    });

    $(".btn-close").on("click", function () {
        $("#custom-alert").hide();
    });

    //click vào OTP -> xoá + thông báo
    $('#verification-code').on("click",function (e) {
        $("#verification-code").val("");
        $(".check-code").html("");
        $(".check-code").removeClass("error success");
    });
    let countdownInterval;

    //xử lý gửi OTP tới email
    $('#sendCode').on("click", function (e) {
        e.preventDefault();
        let email = $("#email").val();
        $(".send").html("");
        $(".send").removeClass("error success");

        if ($('#countdown').text() === "Mã hết hạn") {
            resetCountdown();
        }
        if (email === "") {
            $(".send").addClass("error").html("Vui lòng nhập email.");
        }
        else if (email.indexOf('@') === -1) {
            $(".send").addClass("error").html("Email phải chứa ký tự '@'.");
            return;
        }
        else {
            $('#countdown').show();
            startCountdown();
            $('#sendCode').prop("disabled", true);
            $.post("send_verification_code.php", { email: email }, function (response) {
                let resultClass = response.includes("đã được") ? "success" : "error";
                if (resultClass !== "success") {
                    $(".send").addClass("error").html(response);
                    $('#sendCode').prop("disabled", false);
                    stopCountdown();
                }
            }).fail(function () {
                $(".send").addClass("error").html("Đã xảy ra lỗi khi gửi yêu cầu.");
                $('#sendCode').prop("disabled", false);
            });
        }
    });
    //gửi lại mã sau 60s
    function resetCountdown() {
        clearInterval(countdownInterval);
        $('#countdown').html("Bạn có thể gửi lại mã sau: <span id='timer'>60</span>s");
        $('#timer').text("60");
        $('#sendCode').prop("disabled", false);
    }
    //bắt đầu đếm ngược
    function startCountdown() {
        let time = 59;
        countdownInterval = setInterval(function () {
            $('#timer').text(time);
            if (time <= 0) {
                clearInterval(countdownInterval);
                $('#countdown').text("Mã hết hạn");
                $('#sendCode').prop("disabled", false);
            } else {
                time--;
            }
        }, 1000);
    }
    //dừng đếm ngược
    function stopCountdown() {
        clearInterval(countdownInterval);
        $('#timer').text('0');
        $('#countdown').text('');
        $('#sendCode').prop("disabled", false);
    }

    //xác nhận OTP
    $('#verifyCode').on("click", function (e) {
        e.preventDefault();
        let code = $("#verification-code").val();
        $(".check-code").html("");
        $(".check-code").removeClass("error success");

        if (code === "") {
            $(".check-code").addClass("error").html("Vui lòng nhập mã xác thực.");
        }
        else {
            $.post("verify_code.php", { verification_code: code },
                function (response) {
                    let resultClass = response.includes("đúng") ? "success" : "error";
                    $(".check-code").addClass(` ${resultClass}`).html(response);
                    if (resultClass === "success") {
                        stopCountdown();
                        setTimeout(function () {
                            window.location.href = "../ChangePassword/index.php";
                        }, 500);
                    }
                }).fail(function () {
                    $(".check-code").addClass("error").html(response);
                });
        }
    });
});
