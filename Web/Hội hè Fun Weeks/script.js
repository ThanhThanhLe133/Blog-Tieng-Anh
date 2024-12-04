$(document).ready(() => {
    // load effect
    const fadeInElements = $(".fadeIn-effect");

    const observer = new IntersectionObserver(
        (entries) => {
            entries.forEach((entry) => {
                if (entry.isIntersecting) {
                    $(entry.target).addClass("visible");
                }
            });
        },
        { threshold: 0.5 }
    );

    fadeInElements.each((index, el) => observer.observe(el));


     //register-form
     $('input, select').on('blur', function() {
        let $select = $(this);
        if ($select.val() === "") {
            $select.addClass('error');
            $select.next('.error-message').show();
        } else {
            $select.removeClass('error');
            $select.next('.error-message').hide();
        }
    });

    $('input, select').on('focus', function() {
        $(this).removeClass('error');
        $(this).next('.error-message').hide();
    });
    $('select').on('click', function() {
        let $select = $(this);
        $select.css('color', '#353535');
    });
  
});