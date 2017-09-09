var Article = document.querySelector('article');

steem.api.getContent(author, permalink, function (err, result) {
    var Data = new FormData();
    Data.append('content', result.body);

    //console.warn(result);

    fetch('/modules/feed/markdown.php', {
        method: 'post',
        body  : Data
    }).then(function (response) {
        return response.text();
    }).then(function (body) {
        Article.classList.remove('loading');

        var header = '' +
            '<header class="alignCenter">' +
            '<h1>' + result.title + '</h1>' +
            '<h6>' + result.created + ' · ' + author + '</h6>' +
            '</header>';

        Article.style.opacity = 0;
        Article.innerHTML     = header + body;

        // check headers
        var headers = Article.querySelectorAll('h1');

        for (var i = 0, len = headers.length; i < len; i++) {
            if (headers[i].parentNode.nodeName === 'HEADER') {
                continue;
            }

            if (headers[i].innerHTML === result.title) {
                headers[i].parentNode.removeChild(headers[i]);
            }
        }

        anime({
            targets: Article,
            opacity: 1,
            easing : 'easeInOutQuart'
        });
    });
});