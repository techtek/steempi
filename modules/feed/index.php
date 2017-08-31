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

    <?php for ($i = 0; $i < 10; $i++) { ?>
        <article class="feed-tile">
            <div class="feed-tile-container">
                <div class="feed-tile-image">
                    <img src="https://steemit-production-imageproxy-upload.s3.amazonaws.com/DQmcF4xPPrhcGxBcheaEnWQJTsa2a8Z1Aa4f7HSR597wNmx?AWSAccessKeyId=ASIAJHLABR4BQ6SOJFBQ&Expires=1504154472&Signature=8XJWT9wEw3PD5eB8sFqx3jGhFo0%3D&x-amz-security-token=FQoDYXdzELT%2F%2F%2F%2F%2F%2F%2F%2F%2F%2FwEaDMgDgnUltVa%2BlUQaGiK3A7SQyhWDW7G8tFPgrOUnD%2B0evOUphwSdFBQmuE%2FlJgBBgQw0%2FExILl1T6Jn1TnoNFxeKo2hB5rJbBZ%2Fy337Dvwgq5UmCgeF5FP4sSCSY5B%2BaiwALdNguGt8GZ6Y5MgAj32UQ32mYqkCo%2BWlWhnAgt8ozBDakmkD1MYOu%2F9%2Fgp8f4YmMwoCfOptFibJMoRHZfRsc4EkLsvJ%2FrFZivcsbyYfAtFImDRNee6H%2BAIMQn0ofLtboJBoKZj2W9gNjZ%2BeKCxn9C2YiYWz1L8UBUIU4VjCCNtxE%2FkHc%2B%2BTGMwU9Fgc7fX0Oh5nCmMSH2m4dX6jwyeX8xPbunQoW0vzadwUbt64cQPaYtK3EkURltJH8vovD11yCcSjqujf55xsvcHIXPZM3jkBfTaRwx42egcMikBtBlXUQhfpwKdpOK%2F%2BdT3NJEnlZQd8uZRa0c390fW8Oh80y%2BLaLAX69sXImyvpPN7ONwe9PFd%2FUbckHq%2Fu2RQ971ubaWRfBo2ezZNLvThEmq1SM26lPkTxEa9IDq1HtIrOK5Sh4vMYYEDQ298Zzc46aw%2Bhm5IpyNhBb72viLhW4%2FWfWamLyreikouOmdzQU%3D"/>
                </div>

                <div class="feed-tile-info">
                    <header>
                        <h1>SteemPi v1.0 is here!</h1>
                    </header>
                    <p>
                        I'm happy to finally present to you: SteemPi v1.0 Runs on a (Raspberry) Pi single board computer
                        that
                        connects…
                    </p>
                </div>

                <div class="feed-tile-action">
                    <span class="feed-tile-action-vote">
                        <span class="fa fa-arrow-circle-o-up"></span>
                        <span>150.55 $</span>
                    </span>

                    <span class="feed-tile-action-view">
                        <span class="fa fa-comments-o"></span>
                        <span>120</span>

                        <span class="fa fa-eye"></span>
                        <span>1283</span>
                    </span>
                </div>
            </div>
        </article>
    <?php } ?>

</section>

</body>
</html>