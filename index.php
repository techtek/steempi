<?php

$config = require 'conf/config.php';

?>
<!DOCTYPE html>

<!-- SteemPi webinterface V1.0 -->
<!-- SteemPi webinterface is build with profoundgrid, made by Profound Creative Studio LLC -->
<!-- SteemPi is made by @techtek -->
<!-- SteemPi is made by @dehenne -->

<html lang="en">
<head>
    <meta charset="utf-8"/>
    <title>STEEMPI | A system for Steemit</title>

    <meta http-equiv="content-type" content="text/html; charset=utf-8"/>
    <meta name="viewport" content="initial-scale=1,minimum-scale=1,width=device-width">

    <!-- Stylesheets -->
    <link rel="stylesheet" href="css/style.css" type="text/css" media="screen"/>
    <link rel="stylesheet" href="css/index.css" type="text/css" media="screen"/>

    <!-- Javascript -->
    <script src="/js/jquery-3.2.1.min.js"></script>

    <script>
        var locations = [
            "http://steemitpond.com/",
            "http://steem.loadsup.net/sonar/",
            "http://steemstream.com/",
            "http://steemitboard.com/board.html?user=<?php echo $config['steemitUsername']; ?>",
            "https://steem.makerwannabe.com/index.php?username=<?php echo $config['steemitUsername']; ?>&period=4",
            "http://steem.supply/@<?php echo $config['steemitUsername']; ?>",
            "/headers/spacepi.php",
            "/headers/aquarium.php"
        ];
    </script>
    <script type="text/javascript" src="/js/index.js"></script>
</head>

<body>
<header>
    <div style="text-align: center">
        <img border="0" alt="SteemPi" src="/img/logosteempi.png">
    </div>
</header>

<!-- Switchable header iframe with as default Steemitpond -->
<div class="steemit-pond">
    <iframe id="frame" height="230px" width="100%" src="http://steemitpond.com/"></iframe>
</div>

<!-- Switchable header buttons -->
<div class="header-buttons">
    <button><</button>
    <button>></button>
    <button id="hide">Hide</button>
    <button id="show">Show</button>
    <a class="button" href="settings.php">Settings</a>
</div>

<div class="google-trends container">
    <script type="text/javascript" src="http://ssl.gstatic.com/trends_nrtr/1127_RC02/embed_loader.js"></script>

    <div class="container-box google-trends-box">
        <div>
            <script type="text/javascript">
                trends.embed.renderExploreWidget("TIMESERIES", {
                    "comparisonItem": [{
                        "keyword": "steemit",
                        "geo"    : "",
                        "time"   : "today 12-m"
                    }, {
                        "keyword": "steem",
                        "geo"    : "",
                        "time"   : "today 12-m"
                    }, {
                        "keyword": "myspace",
                        "geo"    : "",
                        "time"   : "today 12-m"
                    }],
                    "category"      : 0,
                    "property"      : ""
                }, {
                    "exploreQuery": "q=steemit,steem,myspace&date=today 12-m",
                    "guestPath"   : "https://trends.google.com:443/trends/embed/"
                });
            </script>
        </div>
    </div>
    <div class="container-box google-trends-box">
        <div>
            <script type="text/javascript">
                trends.embed.renderExploreWidget("TIMESERIES", {
                    "comparisonItem": [{
                        "keyword": "bitcoin",
                        "geo"    : "",
                        "time"   : "today 12-m"
                    }, {
                        "keyword": "ethereum",
                        "geo"    : "",
                        "time"   : "today 12-m"
                    }, {
                        "keyword": "litecoin",
                        "geo"    : "",
                        "time"   : "today 12-m"
                    }],
                    "category"      : 0,
                    "property"      : ""
                }, {
                    "exploreQuery": "q=bitcoin,ethereum,litecoin&date=today 12-m",
                    "guestPath"   : "https://trends.google.com:443/trends/embed/"
                });
            </script>
        </div>
    </div>
    <div class="container-box google-trends-box">
        <div>
            <script type="text/javascript">
                trends.embed.renderExploreWidget("TIMESERIES", {
                    "comparisonItem": [{
                        "keyword": "steemit",
                        "geo"    : "",
                        "time"   : "today 1-m"
                    }, {
                        "keyword": "dtube",
                        "geo"    : "",
                        "time"   : "today 1-m"
                    }, {
                        "keyword": "steem",
                        "geo"    : "",
                        "time"   : "today 1-m"
                    }],
                    "category"      : 0,
                    "property"      : ""
                }, {
                    "exploreQuery": "date=today 1-m&q=steemit,dtube,steem",
                    "guestPath"   : "https://trends.google.com:443/trends/embed/"
                });
            </script>
        </div>
    </div>
    <div class="container-box google-trends-box">
        <div>
            <script type="text/javascript">
                trends.embed.renderExploreWidget("GEO_MAP", {
                    "comparisonItem": [{
                        "keyword": "steemit",
                        "geo"    : "",
                        "time"   : "today 12-m"
                    }, {
                        "keyword": "steem",
                        "geo"    : "",
                        "time"   : "today 12-m"
                    }, {
                        "keyword": "myspace",
                        "geo"    : "",
                        "time"   : "today 12-m"
                    }],
                    "category"      : 0,
                    "property"      : ""
                }, {
                    "exploreQuery": "q=steemit,steem,myspace&date=today 12-m",
                    "guestPath"   : "https://trends.google.com:443/trends/embed/"
                });
            </script>
        </div>
    </div>
    <div class="container-box google-trends-box">
        <div>
            <script type="text/javascript">
                trends.embed.renderExploreWidget("GEO_MAP", {
                    "comparisonItem": [{
                        "keyword": "bitcoin",
                        "geo"    : "",
                        "time"   : "today 12-m"
                    }, {
                        "keyword": "ethereum",
                        "geo"    : "",
                        "time"   : "today 12-m"
                    }, {
                        "keyword": "litecoin",
                        "geo"    : "",
                        "time"   : "today 12-m"
                    }],
                    "category"      : 0,
                    "property"      : ""
                }, {
                    "exploreQuery": "q=bitcoin,ethereum,litecoin&date=today 12-m",
                    "guestPath"   : "https://trends.google.com:443/trends/embed/"
                });
            </script>
        </div>
    </div>
    <div class="container-box google-trends-box">
        <div>
            <script type="text/javascript">
                trends.embed.renderExploreWidget("GEO_MAP", {
                    "comparisonItem": [{
                        "keyword": "steemit",
                        "geo"    : "",
                        "time"   : "today 1-m"
                    }, {
                        "keyword": "dtube",
                        "geo"    : "",
                        "time"   : "today 1-m"
                    }, {
                        "keyword": "steem",
                        "geo"    : "",
                        "time"   : "today 1-m"
                    }],
                    "category"      : 0,
                    "property"      : ""
                }, {
                    "exploreQuery": "date=today 1-m&q=steemit,dtube,steem",
                    "guestPath"   : "https://trends.google.com:443/trends/embed/"
                });
            </script>
        </div>
    </div>
</div>


<!-- Small app drawer: Cointickers, RSS feed scroller, and Live video feeds from the ISS and Aquarium. (to make a feed scroller: http://www.surfing-waves.com/feed.htm -->

<!-- Features -->
<section class="container apps">
    <header>
        <h3>Apps</h3>
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

    <div class="container-box apps-box">
        <!-- start sw-rss-feed code -->
        <script type="text/javascript">
            <!--
            rssfeed_url                         = [];
            rssfeed_url[0]                      = "https://streemian.com/rss/steemdev";
            rssfeed_frame_width                 = "251";
            rssfeed_frame_height                = "150";
            rssfeed_scroll                      = "on";
            rssfeed_scroll_step                 = "6";
            rssfeed_scroll_bar                  = "off";
            rssfeed_target                      = "_blank";
            rssfeed_font_size                   = "12";
            rssfeed_font_face                   = "";
            rssfeed_border                      = "on";
            rssfeed_css_url                     = "";
            rssfeed_title                       = "on";
            rssfeed_title_name                  = "#STEEMDEV";
            rssfeed_title_bgcolor               = "#55a0ff";
            rssfeed_title_color                 = "#fff";
            rssfeed_title_bgimage               = "";
            rssfeed_footer                      = "off";
            rssfeed_footer_name                 = "rss feed";
            rssfeed_footer_bgcolor              = "#fff";
            rssfeed_footer_color                = "#333";
            rssfeed_footer_bgimage              = "";
            rssfeed_item_title_length           = "50";
            rssfeed_item_title_color            = "#000";
            rssfeed_item_bgcolor                = "#fff";
            rssfeed_item_bgimage                = "";
            rssfeed_item_border_bottom          = "on";
            rssfeed_item_source_icon            = "off";
            rssfeed_item_date                   = "off";
            rssfeed_item_description            = "on";
            rssfeed_item_description_length     = "120";
            rssfeed_item_description_color      = "#666";
            rssfeed_item_description_link_color = "#333";
            rssfeed_item_description_tag        = "off";
            rssfeed_no_items                    = "0";
            rssfeed_cache                       = "3609ce984b21b4371b78f174e81b0be6";
            //-->
        </script>

        <script type="text/javascript" src="//feed.surfing-waves.com/js/rss-feed.js"></script>
        <!-- The link below helps keep this service FREE, and helps other people find the SW widget. Please be cool and keep it! Thanks. -->
        <div style="text-align:right; width:230px;">
            <a href="http://www.surfing-waves.com/feed.htm" target="_blank" style="color:#ccc;font-size:10px">
                feedwidget @
            </a> <a href="http://www.surfing-waves.com" target="_blank" style="color:#ccc;font-size:10px">
                Surfing Waves
            </a>
        </div>
        <!-- end sw-rss-feed code -->
    </div>

    <div class="container-box apps-box">
        <!-- start sw-rss-feed code -->
        <script type="text/javascript">
            <!--
            rssfeed_url                         = [];
            rssfeed_url[0]                      = "https://streemian.com/rss/@<?php echo $config['steemitUsername']; ?>";
            rssfeed_frame_width                 = "251";
            rssfeed_frame_height                = "150";
            rssfeed_scroll                      = "on";
            rssfeed_scroll_step                 = "6";
            rssfeed_scroll_bar                  = "off";
            rssfeed_target                      = "_blank";
            rssfeed_font_size                   = "12";
            rssfeed_font_face                   = "";
            rssfeed_border                      = "on";
            rssfeed_css_url                     = "";
            rssfeed_title                       = "on";
            rssfeed_title_name                  = "BLOG @<?php echo $config['steemitUsername']; ?>";
            rssfeed_title_bgcolor               = "#55a0ff";
            rssfeed_title_color                 = "#fff";
            rssfeed_title_bgimage               = "";
            rssfeed_footer                      = "off";
            rssfeed_footer_name                 = "rss feed";
            rssfeed_footer_bgcolor              = "#fff";
            rssfeed_footer_color                = "#333";
            rssfeed_footer_bgimage              = "";
            rssfeed_item_title_length           = "50";
            rssfeed_item_title_color            = "#000";
            rssfeed_item_bgcolor                = "#fff";
            rssfeed_item_bgimage                = "";
            rssfeed_item_border_bottom          = "on";
            rssfeed_item_source_icon            = "off";
            rssfeed_item_date                   = "off";
            rssfeed_item_description            = "on";
            rssfeed_item_description_length     = "120";
            rssfeed_item_description_color      = "#666";
            rssfeed_item_description_link_color = "#333";
            rssfeed_item_description_tag        = "off";
            rssfeed_no_items                    = "0";
            rssfeed_cache                       = "cd5e13a8cb6a8bc7d14f98ca9dd5a0a9";
            //-->
        </script>

        <script type="text/javascript" src="//feed.surfing-waves.com/js/rss-feed.js"></script>
        <!-- The link below helps keep this service FREE, and helps other people find the SW widget. Please be cool and keep it! Thanks. -->
        <div style="text-align:right; width:230px;">
            <a href="http://www.surfing-waves.com/feed.htm" target="_blank" style="color:#ccc;font-size:10px">
                feedwidget @
            </a>
            <a href="http://www.surfing-waves.com" target="_blank" style="color:#ccc;font-size:10px">
                Surfing Waves
            </a>
        </div>
        <!-- end sw-rss-feed code -->
    </div>

    <!-- embedded Live video feed from ustream (for better preformance disable the autoplay value) -->

    <div class="container-box apps-box">
        <iframe src="http://www.ustream.tv/embed/17074538?html5ui=1&autoplay=true"
                style="border: 0 none transparent;" webkitallowfullscreen allowfullscreen frameborder="no"
                width="246" height="150"></iframe>
    </div>

    <div class="container-box apps-box">
        <iframe width="246" height="150" src="http://www.ustream.tv/embed/9600798?html5ui=1&autoplay=true"
                scrolling="no" allowfullscreen webkitallowfullscreen frameborder="0"
                style="border: 0 none transparent;"></iframe>
    </div>
</section>


<!-- links to Steemit related services -->

<section class="container links">
    <header>
        <h3>Links</h3>
    </header>

    <div class="container-box links-box">
        <a href="https://www.steemit.com">
            <img src="/img/steemit.png" alt="Open link" border="0">
        </a>
        <span>Steemit video sharing platform, without cencorship.</span>
    </div>
    <div class="container-box links-box">
        <a href="https://www.dtube.video">
            <img src="/img/dtube.png" alt="Open link" border="0">
        </a>
        <span>Steemit video sharing platform, without cencorship.</span>
    </div>
    <div class="container-box links-box">
        <a href="https://streemian.com/">
            <img src="/img/streemian.png" alt="Open link" border="0">
        </a>
        <span>Steemit video sharing platform, without cencorship.</span>
    </div>
    <div class="container-box links-box">
        <a href="https://steemit.chat/">
            <img src="/img/steemitchat.png" alt="Open link" border="0">
        </a>
        <span>Steemit video sharing platform, without cencorship.</span>
    </div>
    <div class="container-box links-box">
        <a href="http://steemitpond.com/">
            <img src="/img/steemitpond.png" alt="Open link" border="0">
        </a>
        <span>Steemit video sharing platform, without cencorship.</span>
    </div>
    <div class="container-box links-box">
        <a href="http://steemvp.com/">
            <img src="/img/steemmvp.png" alt="Open link" border="0">
        </a>
        <span>Steemit video sharing platform, without cencorship.</span>
    </div>
    <div class="container-box links-box">
        <a href="http://steemstream.com/">
            <img src="/img/steemstreem.png" alt="Open link" border="0">
        </a>
        <span>Steemit video sharing platform, without cencorship.</span>
    </div>
    <div class="container-box links-box">
        <a href="http://steemtracked.com/">
            <img src="/img/steemtracked.png" alt="Open link" border="0">
        </a>
        <span>Steemit video sharing platform, without cencorship.</span>
    </div>
    <div class="container-box links-box">
        <a href="https://www.steemcap.com">
            <img src="/img/steemcap.png" alt="Open link" border="0">
        </a>
        <span>Steemit video sharing platform, without cencorship.</span>
    </div>
    <div class="container-box links-box">
        <a href="https://mentions.steemdata.com">
            <img src="/img/mentions.png" alt="Open link" border="0">
        </a>
        <span>Steemit video sharing platform, without cencorship.</span>
    </div>
    <div class="container-box links-box">
        <a href="http://steem.loadsup.net/sonar/">
            <img src="/img/whalesonar.png" alt="Open link" border="0">
        </a>
        <span>Steemit video sharing platform, without cencorship.</span>
    </div>
    <div class="container-box links-box">
        <a href="https://www.steemit.com/@<?php echo $config['steemitUsername']; ?>">
            <img src="/img/steempi.png" alt="Open link" border="0">
        </a>
        <span>Steemit video sharing platform, without cencorship.</span>
    </div>
</section>


<section class="container downloads">
    <header>
        <h3>STEEMPI</h3>
    </header>

    <a href="https://steemit.com/@techtek">@techtek</a>
    <a href="https://github.com/techtek/steempi/">Source on Github</a>
</section>


<!-- Reference -->
<section class="container reference">
    <header>
        <h3>REFERENCE</h3>
    </header>

    <div class="reference-entry">
        <h4>LED Notifications script</h4>
        <pre>/var/www/html/ledscript/ledscript.sh</span></pre>
        <span>Edit this script and change "@techtek" to your Steemit account</span>
    </div>

    <div class="reference-entry">
        <h4>Edit SteemPi webinterface</h4>
        <pre>/var/www/html/index.php</span></pre>
        <span>Edit this file to add in new functions or change the interface</span>
    </div>
</section>


<!-- Footer -->
<footer>
    <div class="footer-container">
        <header>
            <h3>STEEMPI v. 1.0.0</h3>
        </header>

        <section class="footer-container-links">
            SteemPi is made by: <a href="https://steemit.com/@techtek" target="_blank">@techtek</a>
            and <a href="https://steemit.com/@dehenne" target="_blank">@dehenne</a>
        </section>
    </div>
</footer>

</body>
</html>
