$(document).ready(() => {
     // load effect
     const waveElements = $(".wave-effect");

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
 
     waveElements.each((index, el) => observer.observe(el));
})