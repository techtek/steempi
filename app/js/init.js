// history api
(function () {
    var Router = new Navigo(null, true, '#!');
    var Frame  = document.getElementById('module');

    var openModule = function () {
        var hash  = window.location.hash.replace('\!', '').replace('\#', '');
        Frame.src = '/modules/' + hash + '/index.php';

        console.log(Frame.src);
    };

    Router.on('*', openModule);
    openModule();
})();
