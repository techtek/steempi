// animations
(function () {
    var modules = document.getElementsByClassName('modules-module');

    for (var i = 0, len = modules.length; i < len; i++) {
        modules[i].addEventListener('click', function (event) {
            var Target = event.target;

            if (!Target.classList.contains('modules-module')) {
                Target = Target.parentNode;
            }

            window.parent.location = '/#!' + Target.getAttribute('data-module');
        });

        anime({
            targets: modules[i],
            opacity: 1,
            top    : 0,
            delay  : i * 100,
            easing : 'easeInOutQuart'
        });
    }

    // time
    var Time    = document.querySelector('header time');
    var setTime = function () {
        var html  = '';

        moment.locale(locale_code);

        html = html + '<span class="time">' + moment().format('HH:mm') + '</span>';
        html = html + '<span class="date">' + moment().format('dddd, MMMM Do') + '</span>';

        Time.innerHTML = html;
    };

    setInterval(setTime, 10000);
    setTime();

    anime({
        targets: Time,
        opacity: 1,
        easing : 'easeInOutQuart'
    });
})();
