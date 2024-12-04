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

});