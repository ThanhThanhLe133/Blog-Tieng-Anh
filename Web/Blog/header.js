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

    loadData();
    function loadData() {
        $.post("../../islogin.php", {}, function (response) {
            $(".header__action").html(response);
        });
    }

    $(document).ready(function () {
        $('.header__action').on('click', function () {
            if ($(this).children().first().hasClass('btn--logout')) {
                var result = confirm("Bạn có chắc chắn muốn thoát?");
            }
           
            if (result) {
                setTimeout(function () {
                    window.location.href = "../../user/login/index.php";
                }, 500);
            }
        });
    })
})