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

        let firstName = $('.firstName').val();
        let lastName = $('.lastName').val();
        let phone = $('.phone').val();
        let email = $('.email').val();
        let studySchool = $('.studySchool').val();
        let birthYear = $('.birthYear').val();

        if (!firstName || !lastName || !phone || !email || !studySchool || !birthYear) {
            $('#custom-alert').show();
            $(".message").text("Vui lòng nhập đầy đủ tất cả thông tin.");
            return;
        }
        else if (email.indexOf('@') === -1) {
            $('#custom-alert').show();
            $(".message").text("Email phải chứa ký tự '@'.");
            return;
        }
        else if (/[^0-9]/.test(phone)) {
            $('#custom-alert').show();
            $(".message").text("Số điện thoại không được chứa ký tự chữ cái hoặc ký tự đặc biệt.");
            return;
        }

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
        if( $(".message").text().includes("đã")){
            window.scrollTo(0, 0);
            location.reload();
        }
    });
})