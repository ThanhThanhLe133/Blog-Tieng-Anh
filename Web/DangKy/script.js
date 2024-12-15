$(document).ready(function(){
    $('.register__button').on('click', function (event) {
        event.preventDefault();
    console.log(1222);
    
        const firstName = $('.firstName').val();
        const lastName = $('.lastName').val();
        const phone = $('.phone').val();
        const email = $('.email').val();
        const studySchool = $('.studySchool').val();
        const birthYear = $('.birthYear').val();
        const currentDate = new Date().toISOString().split('T')[0];
    
        console.log(firstName);
        $.post("../../User/send-form.php", {
            firstName: firstName,
            lastName: lastName,
            phone: phone,
            email: email,
            studySchool: studySchool,
            birthYear: birthYear,
            currentDate: currentDate
        }, function (response) {
            if (response.includes("success")) {
                $('#custom-close').show();
            }
            else {
                $('#custom-close').show();
                $(".privacy-policy").hide();
                $(".message").text("Có lỗi xảy ra, vui lòng thử lại.");
            }
        });
    });
    $(".btn-ok").on('click', function (e) {
        e.preventDefault();
        setTimeout(function () {
            window.location.href = "../../User/DangKy/register.php";
        }, 500);
    });
    $('#close-close').on('click', function (e) {
        e.preventDefault();
        $('#custom-close').hide();
        window.scrollTo(0, 0);
        location.reload();
    });
})
