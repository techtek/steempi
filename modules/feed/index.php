<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

require '../../app/autoload.php';
require dirname(__FILE__).'/utils.php';

$Response = getFeed();
$result   = json_decode($Response->getBody(), true);
$feed     = $result['results'];

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
    <link rel="stylesheet" href="css/feed.css" type="text/css"/>
</head>
<body>

<section class="feed">
    <?php

    foreach ($feed as $entry) {
        echo parseFeedItemToArticle($entry);
    }

    ?>
</section>

<script src="//cdn.steemjs.com/lib/latest/steem.min.js"></script>
<script src="/app/js/anime.min.js"></script>
<script src="/modules/feed/js/feed.js"></script>

</body>
</html>