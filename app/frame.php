<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

require 'autoload.php';

$ModuleHandler = new SteemPi\Modules\Handler();
$modules       = $ModuleHandler->getModules();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>STEEMPI | A system for Steemit</title>

    <meta charset="utf-8"/>
    <meta http-equiv="content-type" content="text/html; charset=utf-8"/>
    <meta name="viewport" content="initial-scale=1,minimum-scale=1,width=device-width">

    <!-- Stylesheets -->
    <link rel="stylesheet" href="/app/css/frame.css" type="text/css"/>
    <script>
        var locale_code = '<?php echo \Locale::getDefault();?>';
    </script>
</head>
<body>

<header>
    <img src="images/logo-text.svg"/>
    <time>--:--</time>
</header>

<section class="modules">
    <?php
    /* @var $Module \SteemPi\Modules\Module */
    foreach ($modules as $Module) {
        if (!$Module->isActive()) {
            continue;
        }

        if ($Module->getName() === 'settings') {
            continue;
        }

        ?>
        <div class="modules-module" data-module="<?php echo $Module->getName(); ?>">
            <?php echo $Module->getIcon(); ?>
        </div>

    <?php } ?>
</section>

<script src="/app/js/moment-with-locales.js"></script>
<script src="/app/js/anime.min.js"></script>
<script src="/app/js/frame.js"></script>
</body>
</html>