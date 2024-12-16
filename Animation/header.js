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

   
})