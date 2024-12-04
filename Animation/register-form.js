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
})