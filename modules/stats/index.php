<?php

header("Content-Security-Policy: 
    default-src 'self'; 
    child-src 'self' ssl.gstatic.com www.coingecko.com;
    script-src 'self' ssl.gstatic.com www.coingecko.com"
);

require '../../app/autoload.php';

$Config   = \SteemPi\SteemPi::getConfig();
$username = $Config->get('steemit', 'username');

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>STEEMPI | A system for Steemit</title>

    <meta charset="utf-8"/>
    <meta http-equiv="content-type" content="text/html; charset=utf-8"/>
    <meta name="viewport" content="initial-scale=1,minimum-scale=1,width=device-width">

    <!-- Stylesheets -->
    <link rel="stylesheet" href="css/style.css" type="text/css"/>
</head>
<body>


<section class="google-trends container">
    <header>
        <h3>Trends</h3>
    </header>

    <div class="container-trends">
        <div class="container-box google-trends-box">
            <?php
            $params = array(
                'q'       => 'steemit,steem,facebook,myspace',
                'date'    => 'today 12-m',
                'cmpt'    => 'q',
                'content' => 1,
                'cid'     => 'TIMESERIES_GRAPH_0',
                'export'  => 5
            );
            ?>
            <iframe scrolling="no" height="330"
                    src="http://www.google.com/trends/fetchComponent?<?php echo http_build_query($params) ?>"></iframe>
        </div>

        <div class="container-box google-trends-box">
            <?php
            $params = array(
                'q'       => 'bitcoin,ethereum,litecoin,steem',
                'date'    => 'today 12-m',
                'cmpt'    => 'q',
                'content' => 1,
                'cid'     => 'TIMESERIES_GRAPH_0',
                'export'  => 5
            );
            ?>
            <iframe scrolling="no" height="330"
                    src="http://www.google.com/trends/fetchComponent?<?php echo http_build_query($params) ?>"></iframe>
        </div>


        <div class="container-box google-trends-box">
            <?php
            $params = array(
                'q'       => 'steemit,steem,dtube',
                'date'    => 'today 12-m',
                'cmpt'    => 'q',
                'content' => 1,
                'cid'     => 'TIMESERIES_GRAPH_0',
                'export'  => 5
            );
            ?>
            <iframe scrolling="no" height="330"
                    src="http://www.google.com/trends/fetchComponent?<?php echo http_build_query($params) ?>"></iframe>
        </div>

        <div class="container-box google-trends-box">
            <?php
            $params = array(
                'q'       => 'steemit,steem,myspace',
                'date'    => 'today 12-m',
                'cmpt'    => 'q',
                'content' => 1,
                'cid'     => 'TIMESERIES_GRAPH_0',
                'export'  => 5
            );
            ?>
            <iframe scrolling="no" height="330"
                    src="http://www.google.com/trends/fetchComponent?<?php echo http_build_query($params) ?>"></iframe>
        </div>
    </div>
</section>

<div class="container apps">
    <header>
        <h3>Coin Stats</h3>
    </header>

    <div class="container-box apps-box">
        <iframe src="//www.coingecko.com/en/widget_component/ticker/steem/usd"
                scrolling="no"
                frameborder="0"
                allowtransparency="true"></iframe>
    </div>

    <div class="container-box apps-box">
        <iframe src="//www.coingecko.com/en/widget_component/ticker/steem-dollars/usd"
                scrolling="no"
                frameborder="0"
                allowtransparency="true"></iframe>
    </div>

    <div class="container-box apps-box">
        <iframe src="//www.coingecko.com/en/widget_component/ticker/bitcoin/usd"
                scrolling="no"
                frameborder="0"
                allowtransparency="true"></iframe>
    </div>

    <div class="container-box apps-box">
        <iframe id='widget-ticker-preview'
                src='//www.coingecko.com/en/widget_component/ticker/ethereum/usd?id=ethereum'
                scrolling='no'
                frameborder='0'
                allowTransparency='true'></iframe>
    </div>
</body>
</html>