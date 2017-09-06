<?php

/**
 *   __ _                        ___ _
 *  / _\ |_ ___  ___ _ __ ___   / _ (_)
 *  \ \| __/ _ \/ _ \ '_ ` _ \ / /_)/ |
 *  _\ \ ||  __/  __/ | | | | / ___/| |
 *  \__/\__\___|\___|_| |_| |_\/    |_|
 *
 *
 * SteemPi CLI
 *
 * @author dehenne
 */

if (php_sapi_name() != 'cli') {
    die('Must run from command line');
}

error_reporting(E_ALL | E_STRICT);

ini_set('display_errors', 1);
ini_set('log_errors', 0);
ini_set('html_errors', 0);

require_once 'app/autoload.php';

$strict    = in_array('--strict', $_SERVER['argv']);
$Arguments = new \cli\Arguments(compact('strict'));

$Arguments->addFlag(array('help', 'h'), 'Show this help screen');
$Arguments->addFlag(array('version', 'v'), 'Display the version');
$Arguments->addFlag(array('update'), 'Update SteemPi');

$Arguments->parse();

if ($Arguments['help'] ||
    (!$Arguments['update'] && !$Arguments['version'])
) {
    echo "

  Welcome to
  
   __ _                        ___ _
  / _\ |_ ___  ___ _ __ ___   / _ (_)
  \ \| __/ _ \/ _ \ '_ ` _ \ / /_)/ |
  _\ \ ||  __/  __/ | | | | / ___/| |
  \__/\__\___|\___|_| |_| |_\/    |_|


    ";
    echo $Arguments->getHelpScreen();
    echo PHP_EOL.PHP_EOL;
    exit;
}

if ($Arguments['update']) {
    include 'app/bash/update.php';
    exit;
}