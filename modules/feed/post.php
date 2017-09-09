<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

require '../../app/autoload.php';

$permalink = htmlspecialchars($_GET['permalink']);
$author    = htmlspecialchars($_GET['author']);

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
    <link rel="stylesheet" href="css/post.css" type="text/css"/>
    <link rel="stylesheet" href="css/gutenberg.css">

    <script>
        var permalink = "<?php echo $permalink;?>";
        var author    = "<?php echo $author;?>";
    </script>
</head>
<body>

<article class="loading">
    <span class="fa fa-spinner fa-spin"></span>
</article>

<script src="//cdn.steemjs.com/lib/latest/steem.min.js"></script>
<script src="/app/js/anime.min.js"></script>
<script src="/modules/feed/js/fetch.js"></script>
<script src="/modules/feed/js/post.js"></script>

</body>
</html>