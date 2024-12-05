$(document).ready(function () {
    let showIndex = null;

    const toggleAnswer = (index) => {
        $(".questions__question").each(function () {
            const $question = $(this);
            const questionIndex = $question.data("index");

            if (questionIndex === index) {
                if (showIndex === index) {
                    $question.find(".question__answer").slideUp();
                    $question.find(".question__button").text("+");
                    $question.removeClass("question--active");
                    showIndex = null;
                } else {
                    $question.find(".question__answer").slideDown();
                    $question.find(".question__button").text("-");
                    $question.addClass("question--active");
                    showIndex = index;
                }
            } else {
                $question.removeClass("question--active");
            }
        });
    };  

    $(".questions__question .question__header").on("click", function () {
        const $parent = $(this).closest(".questions__question");
        const index = $parent.data("index");
        toggleAnswer(index);
    });

    $(".questions__question .question__button").on("click", function (e) {
        e.stopPropagation();
        const $parent = $(this).closest(".questions__question");
        const $button = $(this);

        if ($button.html() === "-") {
            $parent.find(".question__answer").slideUp();
            $button.text("+");
            $parent.removeClass("question--active");
        } else {
            $parent.find(".question__answer").slideDown();
            $button.text("-");
            $parent.addClass("question--active");
        }
    });

    $(document).on("mousedown", function (e) {
        if (!$(e.target).closest(".questions__question").length) {
            $(".questions__question").each(function () {
                $(this).removeClass("question--active");
            });
            showIndex = null;
        }
    });
});