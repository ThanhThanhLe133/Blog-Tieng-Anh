$(document).ready(function () {
    $('.register__button').on('click', function (event) {
        event.preventDefault();

        const firstName = $('.firstName').val();
        const lastName = $('.lastName').val();
        const phone = $('.phone').val();
        const email = $('.emailInput').val();
        const studySchool = $('.studySchool').val();
        const birthYear = $('.birthYear').val();
        
        if (firstName === "" || lastName === "" || phone === "" || email === "" || studySchool === "" || birthYear === "") {
            $('#custom-close').show();
            $(".message").text("Vui lòng nhập đầy đủ thông tin");
            return;
        }
        $.post("../../User/send-form.php", {
            firstName: firstName,
            lastName: lastName,
            phone: phone,
            email: email,
            studySchool: studySchool,
            birthYear: birthYear
        }, function (response) {
            if (response.includes("success")) {
                $('#custom-close').show();
            }
            else {
                $('#custom-close').show();
                $(".privacy-policy").hide();
                $(".message").text(response);
                $(".btn-ok").hide();
            }
        });
    });
    $(".btn-ok").on('click', function () {
        setTimeout(function () {
            window.location.href = "../../User/DangKy/index.php";
        }, 500);
    });
    $('.btn-close').on('click', function () {
        $('#custom-close').hide();
        window.scrollTo(0, 0);
        location.reload();
    });
})
