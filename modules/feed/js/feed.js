var articles = document.getElementsByClassName('feed-tile');

/**
 * Search the first image of a steemit post
 *
 * @param {String} body
 * @return {String|Boolean}
 */
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

    // normal images
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

/**
 * Load missing article data
 *
 * @param {HTMLElement} Node
 */
var loadArticleData = function (Node) {
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

/**
 * Close all articles
 *
 * @return {Promise}
 */
var closeArticles = function () {
    return new Promise(function (resolve) {
        for (var i = 0, len = articles.length; i < len; i++) {
            anime({
                targets: articles[i],
                opacity: 0,
                top    : -20,
                delay  : i * 100,
                easing : 'easeInOutQuart'
            });
        }

        setTimeout(resolve, len * 100);
    });
};

/**
 * Set click events to the article
 *
 * @param {HTMLElement} Node
 */
var setArticleEvents = function (Node) {
    Node.addEventListener('click', function () {
        closeArticles().then(function () {
            var permlink = Node.getAttribute('data-permlink');
            var author   = Node.getAttribute('data-author');

            var path = window.location.pathname.replace('index.php', 'post.php');

            var url = path + '?';
            url += 'permalink=' + permlink;
            url += '&author=' + author;

            window.location = url;
        })
    });
};

// build articles
for (var i = 0, len = articles.length; i < len; i++) {
    loadArticleData(articles[i]);
    setArticleEvents(articles[i]);

    anime({
        targets: articles[i],
        opacity: 1,
        top    : 0,
        delay  : i * 100,
        easing : 'easeInOutQuart'
    });
}