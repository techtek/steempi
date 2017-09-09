var articles = document.getElementsByClassName('feed-tile');

var getImageUrlFromPost = function (body) {
// markdown
    var start = body.indexOf('![');

    if (start !== -1) {
        var startImageUrl = body.indexOf('](', start);
        var endImageUrl   = body.indexOf(')', start);

        return body.substr(
            startImageUrl + 2,
            endImageUrl - startImageUrl - 2
        );
    }

    start = body.indexOf('https://steemitimages.com');

    if (start !== -1) {
        var end = body.substr(start).match(/<| /).index;

        return body.substr(
            start,
            end
        ).trim();
    }

    return false;
};

var loadImage = function (Node) {
    var permlink = Node.getAttribute('data-permlink');
    var author   = Node.getAttribute('data-author');

    steem.api.getContent(author, permlink, function (err, result) {
        if (typeof result.body === 'undefined') {
            return;
        }

        var body  = result.body;
        var image = getImageUrlFromPost(body);

        if (!image) {
            return;
        }

        var Image = document.createElement('img');
        Image.src = image;

        var ImageContainer = Node.getElementsByClassName('feed-tile-image')[0];
        ImageContainer.appendChild(Image);
    });
};

for (var i = 0, len = articles.length; i < len; i++) {
    loadImage(articles[i]);

    anime({
        targets: articles[i],
        opacity: 1,
        top    : 0,
        delay  : i * 100,
        easing : 'easeInOutQuart'
    });
}