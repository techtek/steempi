<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

require '../../app/autoload.php';

$Config   = SteemPi\SteemPi::getConfig();
$username = $Config->get('steemit', 'username');

// not working for a RPI
$Client   = new GuzzleHttp\Client();
$Response = $Client->request('GET', 'https://api.asksteem.com/search', [
    'query' => ['q' => 'steemit']
]);

//$SteemArticle = new \SteemPHP\SteemArticle('https://steemd.steemit.com');
//$feed         = $SteemArticle->getDiscussionsByCreated('steemit', 10);

$result = json_decode($Response->getBody(), true);
$feed   = $result['results'];

?>
<!DOCTYPE html>

<!-- SteemPi webinterface V2.0 -->
<!-- SteemPi is made by @techtek -->
<!-- SteemPi is made by @dehenne -->

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
        $description = strip_tags($entry['summary']);
        $category    = $entry['tags'][0];

        $entry['pending_payout_value'] = 0;
        $entry['active_votes'] = 0;

        if (strlen($description) > 120) {
            $description = mb_substr($description, 0, 120).'...';
        }

        $link = 'https://steemit.com/';
        $link .= $category.'/';
        $link .= '@'.$entry['author'].'/';
        $link .= $entry['permlink'];

//        $jsonMeta = json_decode($entry['json_metadata'], true);
        $image = '';

//        if (isset($jsonMeta['image'])
//            && $jsonMeta['image']
//            && is_array($jsonMeta['image'])
//            && count($jsonMeta['image'])
//        ) {
//            $image = $jsonMeta['image'][0];
//        }

        ?>
        <article class="feed-tile" data-link="<?php echo $link; ?>">
            <div class="feed-tile-container">
                <div class="feed-tile-image">
                    <?php if ($image) { ?>
                        <img src="<?php echo $image; ?>"/>
                    <?php } ?>
                </div>


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
                        <span><?php echo count($entry['active_votes']); ?></span>
                    </span>
                </div>
            </div>
        </article>
    <?php } ?>

</section>

</body>
</html>