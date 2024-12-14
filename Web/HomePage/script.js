$(document).ready(() => {

    //slide image .top
    let currentIndex1 = 0;
    const slides1 = $('.image-slide.top ul li');
    const totalSlides1 = slides1.length;

    function showNextSlide1() {
        currentIndex1++;
        if (currentIndex1 >= totalSlides1) {
            currentIndex1 = 0; 
        }
        updateSlidePosition1();
    }

    function showPreviousSlide1() {
        if (currentIndex1 > 0) {
            currentIndex1--; 
        }        
        updateSlidePosition1();
    }

    function updateSlidePosition1() {
        const slideContainer = $('.image-slide.top ul');
        const slideWidth = slides1.outerWidth();
        slideContainer.css('transform', `translateX(-${currentIndex1 * slideWidth}px)`);
    }

    $('.top .prev').on('click', showPreviousSlide1);
    $('.top .next').on('click', showNextSlide1);
    
    setInterval(showNextSlide1, 5000);

     //slide image .method
     let currentIndex2 = 0;
     const slides2 = $('.image-slide.method ul li');
     const totalSlides2 = slides2.length;
 
     function showNextSlide2() {
         currentIndex2++;
         if (currentIndex2 >= totalSlides2) {
             currentIndex2 = 0; 
         }
         updateSlidePosition2();
     }
 
     function showPreviousSlide2() {
         if (currentIndex2 > 0) {
             currentIndex2--; 
         }        
         updateSlidePosition2();
     }
 
     function updateSlidePosition2() {
         const slideContainer = $('.image-slide.method ul');
         const slideWidth = slides2.outerWidth(); // Sử dụng outerWidth để lấy chiều rộng bao gồm padding
         slideContainer.css('transform', `translateX(-${currentIndex2 * slideWidth}px)`);
     }
 
     $('.method .prev').on('click', showPreviousSlide2);
     $('.method .next').on('click', showNextSlide2);
     
     setInterval(showNextSlide2, 3000);
});