$(document).ready(() => {
     //register-form
     $('input, select').on('blur', function() {
        let $select = $(this);
        if ($select.val() === "") {
            $select.addClass('error');
            $select.next('.register__error').show();
        } else {
            $select.removeClass('error');
            $select.next('.register__error').hide();
        }
    });

    $('input, select').on('focus', function() {
        $(this).removeClass('error');
        $(this).next('.register__error').hide();
    });
    $('select').on('click', function() {
        let $select = $(this);
        $select.css('color', '#353535');
    });
    $('.register__button').on('click', function (event) {
        event.preventDefault();
    
        const firstName = $('#first_name').val();
        const lastName = $('#last_name').val();
        const phone = $('#phone').val();
        const email = $('#email').val();
        const studySchool = $('#study_school').val();
        const birthYear = $('#birth_year').val();
    
        let studentData = JSON.parse(localStorage.getItem('studentData')) || [];
        studentData.push({
            firstName,
            lastName,
            phone,
            email,
            studySchool,
            birthYear
        });
        localStorage.setItem('studentData', JSON.stringify(studentData));
        $('#custom-alert').css("display","block");
    });
    
    $('#close-alert').on('click', function (e) {
        e.preventDefault();
        $('#custom-alert').hide();
        window.scrollTo(0, 0);
        location.reload();
    });
    
})