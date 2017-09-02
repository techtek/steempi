<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

require 'app/autoload.php';

$ModuleHandler = new SteemPi\Modules\Handler();
$modules       = $ModuleHandler->getModules();

?>
<!-- SteemPi webinterface V2.0 -->
<!-- SteemPi is made by @dehenne -->
<!-- SteemPi is made by @techtek -->
<!DOCTYPE html>
<html lang="en">
<head>
    <title>STEEMPI | A system for Steemit</title>

    <meta charset="utf-8"/>
    <meta http-equiv="content-type" content="text/html; charset=utf-8"/>
    <meta name="viewport" content="initial-scale=1,minimum-scale=1,width=device-width">

    <!-- Stylesheets -->
    <link rel="stylesheet" href="app/css/style.css" type="text/css"/>
    <link rel="stylesheet" href="app/css/font-awesome/css/font-awesome.min.css" type="text/css"/>
</head>

<body>

<div id="app">
    <nav>
        <a href="/" class="steemPi-logo">
            <img src="/app/images/logo.svg" class="logo"/>
            <img src="/app/images/logo-text.svg" class="logo-text"/>
        </a>

        <ul class="navigation">
            <?php foreach ($modules as $Module) { ?>
                <li class="navigation-entry">
                    <?php
                    /* @var $Module \SteemPi\Modules\Module */
                    if (!$Module->extendsLeftMenu()) {
                        continue;
                    }

                    $MenuItem = $Module->getLeftMenu();
                    echo $MenuItem->create();
                    ?>
                </li>
            <?php } ?>
        </ul>
    </nav>

    <header>
        <section class="header-buttons">
            <a href="" class="header-buttons-button">
                <span class="fa fa-bell-o"></span>
            </a>

            <?php foreach ($modules as $Module) {

                /* @var $Module \SteemPi\Modules\Module */
                if (!$Module->extendsTopMenu()) {
                    continue;
                }

                $MenuItem = $Module->getTopMenu();
                $MenuItem->addClass('header-buttons-button');

                echo $MenuItem->create();

            } ?>
        </section>
    </header>

    <main>
        <iframe id="module" src="app/frame.php"></iframe>
    </main>
</div>

<script src="app/js/navigo.min.js"></script>
<script src="app/js/init.js"></script>
</body>
</html>
