$(document).ready(function () {
    $('#email').click(function (e) {
        $(".send").html("");
        $(".send").removeClass("error success");
    });
    $('#verification-code').click(function (e) {
        $(".check-code").html("");
        $(".check-code").removeClass("error success");
    });
    let countdownInterval;
    $('#sendCode').click(function (e) {
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
    function resetCountdown() {
        clearInterval(countdownInterval);
        $('#countdown').html("Bạn có thể gửi lại mã sau: <span id='timer'>30</span>s");
        $('#timer').text("30");
        $('#sendCode').prop("disabled", false);
    }
    function startCountdown() {
        let time = 29;
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
    function stopCountdown() {
        clearInterval(countdownInterval);
        $('#timer').text('0');
        $('#countdown').text('');
        $('#sendCode').prop("disabled", false);
    }
    $('#verifyCode').click(function (e) {
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
