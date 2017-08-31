// history api
(function () {
    var Router = new Navigo(null, true, '#!');
    var Frame  = document.getElementById('module');

    Router.on('*', function () {
        var hash  = window.location.hash.replace('\!', '').replace('\#', '');
        Frame.src = '/modules/' + hash + '/index.php';
    });
})();
