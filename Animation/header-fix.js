$(document).ready(() => {
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