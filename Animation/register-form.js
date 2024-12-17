$(document).ready(() => {
    //register-form
    $('input, select').on('blur', function () {
        let $select = $(this);
        if ($select.val() === "") {
            $select.addClass('error');
            $select.next('.register__error').show();
        } else {
            $select.removeClass('error');
            $select.next('.register__error').hide();
        }
    });

    $('input, select').on('focus', function () {
        $(this).removeClass('error');
        $(this).next('.register__error').hide();
    });
    $('select').on('click', function () {
        let $select = $(this);
        $select.css('color', '#353535');
    });
    $('.register__button').on('click', function (event) {
        event.preventDefault();

        const firstName = $('.firstName').val();
        const lastName = $('.lastName').val();
        const phone = $('.phone').val();
        const email = $('.email').val();
        const studySchool = $('.studySchool').val();
        const birthYear = $('.birthYear').val();

        console.log(firstName);
        $.post("../../Admin/send-form.php", {
            firstName: firstName,
            lastName: lastName,
            phone: phone,
            email: email,
            studySchool: studySchool,
            birthYear: birthYear
        }, function (response) {
            $('#custom-alert').show();
            $(".message").text(response);
        }).fail(function () {
            $('#custom-alert').show();
            $(".message").text("Có lỗi xảy ra, vui lòng thử lại.");
        });
    });

    $('#close-alert').on('click', function (e) {
        e.preventDefault();
        $('#custom-alert').hide();
        window.scrollTo(0, 0);
        location.reload();
    });
})