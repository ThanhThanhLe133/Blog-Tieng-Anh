$(document).ready(() => {
    AOS.init();
    // load effect
    const waveElements = $(".wave-effect");
    const fadeInElements = $(".fadeIn-effect");

    const observer = createObserver();
    observeElements(observer, waveElements);
    observeElements(observer, fadeInElements);

    function createObserver() {
        return new IntersectionObserver(
            (entries) => {
                entries.forEach((entry) => {
                    if (entry.isIntersecting) {
                        $(entry.target).addClass("visible");
                    }
                });
            },
            { threshold: 0.5 }
        );
    }

    function observeElements(observer, elements) {
        elements.each((index, el) => {
            observer.observe(el);
        });
    }
})