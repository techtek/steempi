var leds = document.querySelectorAll('.led-tests-images img');

var click = function (event) {
    var Target = event.target;
    var led    = Target.getAttribute('data-led');

    var Data = new FormData();
    Data.append('led', led);

    Target.classList.add('on');

    fetch('/app/tests/ledtest.php', {
        method: 'post',
        body  : Data
    }).then(function (response) {
        return response.text();
    }).then(function (body) {
        Target.classList.remove('on');
    });
};

for (var i = 0, len = leds.length; i < len; i++) {
    leds[i].addEventListener('click', click);
}
