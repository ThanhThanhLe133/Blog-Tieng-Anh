$(document).ready(() => {
    //gallery
    let currentSlideIndex = 0;
    const images = [
        "images/pexels-photo-8613174.jpeg",
        "images/kid-activity.jpg",
        "images/kid-edu.jpg"
    ];

    // Mở modal khi nhấn vào ảnh
    $('.gallery-icon').on('click', function () {
        currentSlideIndex = $(this).parent().parent().index();
        $('#modalImage').attr('src', images[currentSlideIndex]);
        $('.gallery-image').fadeIn();
    });

    // Đóng modal
    $('.close').on('click', function () {
        $('.gallery-image').fadeOut();
    });

    // Điều hướng slide
    $('.prev').on('click', function () {
        currentSlideIndex = (currentSlideIndex - 1 + images.length) % images.length;
        $('#modalImage').attr('src', images[currentSlideIndex]);
    });

    $('.next').on('click', function () {
        currentSlideIndex = (currentSlideIndex + 1) % images.length;
        $('#modalImage').attr('src', images[currentSlideIndex]);
    });

    // Đóng modal khi nhấn ngoài modal
    $(window).on('click', function (e) {
        if ($(e.target).is('.gallery-image')) {
            $('.gallery-image').fadeOut();
        }
    }); 
    // Tự động chuyển ảnh sau 
    setInterval(function () {
        if ($('.gallery-image').is(':visible')) {
            currentSlideIndex = (currentSlideIndex + 1) % images.length;
            $('#modalImage').attr('src', images[currentSlideIndex]);
        }
    }, 5000);
});