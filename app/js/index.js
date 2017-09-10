// history api
(function () {
    var Router = new Navigo(null, true, '#!');
    var Frame  = document.getElementById('module');

    var openModule = function () {
        if (window.location.hash === '') {
            Frame.src = '/app/frame.php';
            return;
        }

        var hash  = window.location.hash.replace('\!', '').replace('\#', '');
        Frame.src = '/modules/' + hash + '/index.php';
    };

    Router.on('*', openModule);
    openModule();
})();

(function () {
    var Main      = document.querySelector('main');
    var Nav       = document.querySelector('nav');
    var HeaderNav = document.querySelector('.header-menu');

    var showMenu = function () {
        anime({
            targets    : Main,
            paddingLeft: 60,
            easing     : 'easeInOutQuart',
            duration   : 500
        });

        anime({
            targets : Nav,
            left    : 0,
            easing  : 'easeInOutQuart',
            duration: 500
        });
    };

    var hideMenu = function () {
        anime({
            targets    : Main,
            paddingLeft: 0,
            easing     : 'easeInOutQuart',
            duration   : 500
        });

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

    HeaderNav.addEventListener('focus', focusNav);
    HeaderNav.addEventListener('mouseenter', focusNav);
    
    Nav.addEventListener('focus', showMenu);
    Nav.addEventListener('blur', hideMenu);

    var entries = Nav.querySelectorAll('li a');

    for (var i = 0, len = entries.length; i < len; i++) {
        entries[i].addEventListener('click', hideMenu);
    }
})();