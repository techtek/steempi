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

$executeUser = shell_exec('id -u');
$executeUser = trim($executeUser);
$executeUser = (int)$executeUser;

if ($executeUser !== 0) {
    \cli\Colors::enable();
    \cli\line('Please use %Csudo ./steempi update%n to update SteemPi%n', true);
    \cli\Colors::disable();
    exit;
}

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


include dirname(__FILE__).'/locale.php';

include dirname(__FILE__).'/composer.php';

include dirname(__FILE__).'/chown.php';

echo PHP_EOL;
echo PHP_EOL;
echo "I am done. We wish you a lot of fun with SteemPi - @dehenne and @Techtek";
echo PHP_EOL;
