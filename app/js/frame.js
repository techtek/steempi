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
        var Now   = new Date();
        var min   = ('0' + Now.getMinutes()).slice(-2);
        var hours = ('0' + Now.getHours()).slice(-2);

        Time.innerHTML = hours + ':' + min;
    };

    setInterval(setTime, 10000);
    setTime();

    anime({
        targets: Time,
        opacity: 1,
        easing : 'easeInOutQuart'
    });
})();
