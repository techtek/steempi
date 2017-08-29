var currentIndex = 0;
var len          = locations.length;

$(document).ready(function () {
    $(':button').click(function () {
        currentIndex = this.value === ">" ?
            currentIndex < len - 1 ? ++currentIndex : len - 1 :
            currentIndex > 0 ? --currentIndex : 0;
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
