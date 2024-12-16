$(document).ready(() => {
    $('.language').click(function () {
        var vietnamese = $('.language.vietnamese');
        var english = $('.language.english');

        var vietnameseText = vietnamese.find('.language__text').text();
        var englishText = english.find('.language__text').text();
        var vietnameseFlag = vietnamese.find('.language__flag img').attr('src');
        var englishFlag = english.find('.language__flag img').attr('src');

        vietnamese.find('.language__text').text(englishText);
        vietnamese.find('.language__flag img').attr('src', englishFlag);

        english.find('.language__text').text(vietnameseText);
        english.find('.language__flag img').attr('src', vietnameseFlag);
    });

    //.header.fixed
    const header = $('.main-container__header--fixed');
    $(window).on('scroll', function () {
        if ($(this).scrollTop() === 0) {
            header.css('top', '42px');
        } else {
            header.css('top', '0px');
        }
    });

    function loadData() {
        
        $.post("http://localhost/BlogTiengAnh/animation/islogin.php", {}, function (response) {
            $(".header__action").html(response);
        });
    }
    loadData();
    $(document).ready(function () {
        $('.header__action').on('click', function () {
            if ($(this).children().first().hasClass('btn--logout')) {
                var result = confirm("Bạn có chắc chắn muốn thoát?");
            }
           
            if (result) {
                setTimeout(function () {
                    window.location.href = "http://localhost/BlogTiengAnh/user/login/index.php";
                }, 500);
            }
        });
    })
})