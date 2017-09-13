var Router = new Navigo(null, true, '#!');

// history api
(function () {
    var Frame = document.getElementById('module');

    var openModule = function () {
        if (window.location.hash === '') {
            Frame.src = '/app/frame.php';
            return;
        }

        var hash = window.location.hash.replace('\!', '').replace('\#', '');

        if (hash === '') {
            Frame.src = '/app/frame.php';
            return;
        }

        Frame.src = '/modules/' + hash + '/index.php';
    };

    Router.on('*', openModule);
    openModule();
})();

// navigation events
(function () {
    var Main      = document.querySelector('main');
    var Nav       = document.querySelector('nav');
    var HeaderNav = document.querySelector('.header-menu');

    document.querySelector('.steemPi-logo').addEventListener('mousedoen', function (event) {
        event.preventDefault();
    });

    document.querySelector('.steemPi-logo').addEventListener('click', function (event) {
        event.preventDefault();
        Router.navigate('');
    });

    var showMenu = function () {
        // anime({
        //     targets    : Main,
        //     paddingLeft: 60,
        //     easing     : 'easeInOutQuart',
        //     duration   : 500
        // });

        anime({
            targets : Nav,
            left    : 0,
            easing  : 'easeInOutQuart',
            duration: 200,
            complete: function () {
                Nav.classList.add('nav-opened');
            }
        });
    };

    var hideMenu = function () {
        // anime({
        //     targets    : Main,
        //     paddingLeft: 0,
        //     easing     : 'easeInOutQuart',
        //     duration   : 500
        // });

        Nav.classList.remove('nav-opened');

        anime({
            targets : Nav,
            left    : -60,
            easing  : 'easeInOutQuart',
            duration: 500
        });
    };

    var focusNav = function () {
        Nav.focus();
    };

    setTimeout(hideMenu, 2000);

    HeaderNav.tabIndex = -1;
    Nav.tabIndex       = -1;

    // HeaderNav.addEventListener('focus', focusNav, false);
    HeaderNav.addEventListener('click', focusNav, false);

    HeaderNav.addEventListener("touchstart", function (event) {
        event.preventDefault();
        focusNav();
    }, false);


    Nav.addEventListener('focus', showMenu, false);
    Nav.addEventListener('blur', hideMenu, false);

    var entries = Nav.querySelectorAll('li a');

    for (var i = 0, len = entries.length; i < len; i++) {
        entries[i].addEventListener('mouseup', hideMenu);
    }
})();