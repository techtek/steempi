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
