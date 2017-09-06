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
$php    = command_exist('php');

//if nothing is installed, we want to install LIGHTTPD
if (!$apache && !$light) {
    echo PHP_EOL;
    echo "No Webserver is installed. I will install lighttpd for you.".PHP_EOL;
    system('apt-get install lighttpd');
}

// if no php exists, we want php7
if (!$php) {
    echo PHP_EOL;
    echo "No PHP is installed. I will install php7 for you.".PHP_EOL;
    system(
        'echo "deb http://httpredir.debian.org/debian stretch main contrib non-free" | tee /etc/apt/sources.list.d/debian-stretch.list'
    );

    system('apt-get update -y');
    system('apt install php7.0 php7.0-fpm php7.0-mbstring -t stretch -y');
    system('rm /etc/apt/sources.list.d/debian-stretch.list');
    system('apt-get update -y');

    if ($light) {
        system('
        sudo tee /etc/lighttpd/conf-enabled/php.conf > /dev/null <<EOF
fastcgi.server += (".php" => ((
        "socket" => "/var/run/php/php7.0-fpm.sock"
)))
EOF
        ');

        system('sudo lighttpd-enable-mod fastcgi');
        system('sudo /etc/init.d/lighttpd force-reload');
    }
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
