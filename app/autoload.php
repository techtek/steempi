<?php

/**
 * Autoload
 */
$Loader = require dirname(dirname(__FILE__)).'/vendor/autoload.php';
$Loader->setPsr4('SteemPi\\', __DIR__.'/src/SteemPi/');

/**
 * Localization
 *
 * msgfmt xxx.po -o xxx.mo
 */

\SteemPi\SteemPi::loadLanguage();
