<?php

/**
 *   __ _                        ___ _
 *  / _\ |_ ___  ___ _ __ ___   / _ (_)
 *  \ \| __/ _ \/ _ \ '_ ` _ \ / /_)/ |
 *  _\ \ ||  __/  __/ | | | | / ___/| |
 *  \__/\__\___|\___|_| |_| |_\/    |_|
 *
 *
 * This script updates steempi
 *
 */

$dir = dirname(dirname(dirname(__FILE__)));

echo "Starting SteemPi Update...".PHP_EOL;

// on which branch we are
$result = shell_exec('git branch');
$result = explode("\n", trim($result));
$result = array_filter($result, function ($entry) {
    return strpos($entry, '*') !== false;
});

$branch = trim(trim($result[0], '*'));

system('git fetch');
system('git reset --hard origin/'.$branch);

include dirname(__FILE__).'/composer.php';
include dirname(__FILE__).'/chown.php';