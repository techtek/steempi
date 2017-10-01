<?php

/**
 *   __ _                        ___ _
 *  / _\ |_ ___  ___ _ __ ___   / _ (_)
 *  \ \| __/ _ \/ _ \ '_ ` _ \ / /_)/ |
 *  _\ \ ||  __/  __/ | | | | / ___/| |
 *  \__/\__\___|\___|_| |_| |_\/    |_|
 *
 *
 * This script installs SteemPi
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
    system('apt-get install lighttpd -y');

    // we must add fast-cgi to the lighttp
    system(
        'tee /etc/lighttpd/conf-enabled/php.conf > /dev/null <<EOF
fastcgi.server += (".php" => ((
    "socket" => "/var/run/php/php7.0-fpm.sock"
)))
EOF'
    );

    system('lighttpd-enable-mod fastcgi');
    system('/etc/init.d/lighttpd force-reload');
}

if (!command_exist('gpio')) {
    echo PHP_EOL;
    echo "No GPIO connection is installed. I will install wiringpi for you.".PHP_EOL;
    system('apt-get install wiringpi -y');

}

if (!function_exists('mb_substr()')) {
    system('apt-get php7.0-mbstring -y');
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

// create etc folder
if (!is_dir($dir.'/etc/')) {
    mkdir($dir.'/etc/');

    $conf = '
    ;<?php exit; ?>

[steempi]
language = "en_EN"
modulesOrder = "feed,dtube,spectacles,steemstream,steemsupply,discord,WhaleSonar,Steemitpond,stats,issLive,bitcoinexplorer,duckduckgo,MontereyBayAquarium,openhab,raspberrypiorg,tedcom,settings"

[steemit]
username = ""

[modules]
feed = 1
issLive = 0
settings = 1
stats = 1
Steemitpond = 1
WhaleSonar = 1
discord = 1
bitcoinexplorer = 0
dtube = 1
duckduckgo = 0
MontereyBayAquarium = 0
openhab = 0
raspberrypiorg = 0
spectacles = 1
steemstream = 1
steemsupply = 1
tedcom = 0

';

    file_put_contents($dir.'/etc/conf.ini.php', $conf);
}

if (!class_exists('\Locale')) {
    if (version_compare(PHP_VERSION, '7.0.0') >= 0) {
        system('apt-get install php7.0-intl -y');
    } else {
        system('apt-get install php5-intl -y');
    }
}

$dir = dirname(dirname(dirname(__FILE__)));

system($dir.'/steempi update');
