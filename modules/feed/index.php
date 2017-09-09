<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

require '../../app/autoload.php';

$Feed = SteemPi\SteemPi::getModuleHandler()->getModule('feed');

$tags      = $Feed->getSetting('feed', 'filter-tags');
$userNames = $Feed->getSetting('feed', 'filter-usernames');
$query     = array();

if (!empty($tags)) {
    $tags = preg_replace('/[^A-Za-z0-9\-]/', '', $tags);
    $tags = explode(' ', $tags);


    foreach ($tags as $tag) {
        $query[] = 'tags:'.$tag;
    }
}

if (!empty($userNames)) {
    $userNames = str_replace('@', '', $userNames);
    $userNames = str_replace(',', ' ', $userNames);
    $userNames = str_replace(';', ' ', $userNames);
    $userNames = preg_replace('/\s+/', ' ', $userNames);
    $userNames = explode(' ', $userNames);

    foreach ($userNames as $username) {
        $query[] = 'author:'.$username;
    }
}

if (empty($query)) {
    $query[] = 'tags:steempi';
}

$Client   = new GuzzleHttp\Client();
$Response = $Client->request('GET', 'https://api.asksteem.com/search', [
    'query' => ['q' => implode(' ', $query)]
]);

//$SteemArticle = new \SteemPHP\SteemArticle('https://steemd.steemit.com');
//$feed         = $SteemArticle->getDiscussionsByCreated('steemit', 10);

$result = json_decode($Response->getBody(), true);
$feed   = $result['results'];

// sort feed
usort($feed, function ($entryA, $entryB) {
    return strtotime($entryA["created"]) - strtotime($entryB["created"]);
});

?>
<!DOCTYPE html>

<!-- SteemPi webinterface V2.0 -->
<!-- SteemPi is made by @dehenne -->
<!-- SteemPi is made by @techtek -->

<html lang="en">
<head>
    <title>STEEMPI | A system for Steemit</title>

    <meta charset="utf-8"/>
    <meta http-equiv="content-type" content="text/html; charset=utf-8"/>
    <meta name="viewport" content="initial-scale=1,minimum-scale=1,width=device-width">

    <!-- Stylesheets -->
    <link rel="stylesheet" href="../../app/css/font-awesome/css/font-awesome.min.css" type="text/css"/>
    <link rel="stylesheet" href="css/style.css" type="text/css"/>
</head>
<body>

<section class="feed">

    <?php

    foreach ($feed as $entry) {
//        echo '<pre>';
//        var_dump($entry);
//        exit;
        $description = strip_tags($entry['summary']);
        $category    = $entry['tags'][0];

        $entry['pending_payout_value'] = 0;

        if (mb_strlen($description) > 120) {
            $description = mb_substr($description, 0, 120).'...';
        }

        $link = 'https://steemit.com/';
        $link .= $category.'/';
        $link .= '@'.$entry['author'].'/';
        $link .= $entry['permlink'];

        ?>
        <article class="feed-tile"
                 data-link="<?php echo $link; ?>"
                 data-permlink="<?php echo $entry['permlink']; ?>"
                 data-author="<?php echo $entry['author']; ?>"
        >
            <div class="feed-tile-container">
                <div class="feed-tile-image"></div>

                <div class="feed-tile-info">
                    <header>
                        <h1><?php echo $entry['title']; ?></h1>
                    </header>
                    <p><?php echo $description; ?></p>
                </div>

                <div class="feed-tile-action">
                    <span class="feed-tile-action-vote">
                        <span class="fa fa-arrow-circle-o-up"></span>
                        <span><?php echo $entry['pending_payout_value']; ?></span>
                    </span>

                    <span class="feed-tile-action-view">
                        <span class="fa fa-hand-o-up"></span>
                        <span><?php echo $entry['net_votes']; ?></span>
                    </span>
                </div>
            </div>
        </article>
    <?php } ?>

</section>

<script src="//cdn.steemjs.com/lib/latest/steem.min.js"></script>
<script src="/app/js/anime.min.js"></script>
<script src="/modules/feed/js/feed.js"></script>

</body>
</html>