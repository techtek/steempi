<?php

/**
 *   __ _                        ___ _
 *  / _\ |_ ___  ___ _ __ ___   / _ (_)
 *  \ \| __/ _ \/ _ \ '_ ` _ \ / /_)/ |
 *  _\ \ ||  __/  __/ | | | | / ___/| |
 *  \__/\__\___|\___|_| |_| |_\/    |_|
 *
 *
 * This script installs steempi
 *
 */

require_once 'utils.php';

$dir = dirname(dirname(dirname(__FILE__)));

// first, we make a full update
system('apt-get update -y');
system('apt-get upgrade -y');

// what is installed?
$apache = command_exist('apache2');
$light  = command_exist('lighttpd');

//if nothing is installed, we want to install LIGHTTPD
if (!$apache && !$light) {
    echo PHP_EOL;
    echo "No Webserver is installed. I will install lighttpd for you.".PHP_EOL;
    system('apt-get install lighttpd');
}

// SteemPi
echo "Now i will install SteemPi for you.".PHP_EOL;

chdir($dir);

if (file_exists('/var/www/html/index.lighttpd.html')) {
    unlink('/var/www/html/index.lighttpd.html');
}

system('apt-get update -y');
system('git clone https://github.com/techtek/steempi.git .');

// checkout dev
system('git checkout -b dev origin/dev');

// composer
include 'composer.php';

// set chown
include 'chown.php';
