$(document).ready(function () {
    var currentIndex = 0;

    $('.header-buttons .previous,.header-buttons .next').click(function () {
        if (this.getAttribute('data-value') === ">") {
            currentIndex++;
        } else {
            currentIndex--
        }

        $('#frame').attr('src', locations[currentIndex]);
    });

    // header
    $("#hide").click(function () {
        $(".steemit-pond").hide();
    });
    $("#show").click(function () {
        $(".steemit-pond").show();
    });
});
