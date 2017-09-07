<?php

/**
 *   __ _                        ___ _
 *  / _\ |_ ___  ___ _ __ ___   / _ (_)
 *  \ \| __/ _ \/ _ \ '_ ` _ \ / /_)/ |
 *  _\ \ ||  __/  __/ | | | | / ___/| |
 *  \__/\__\___|\___|_| |_| |_\/    |_|
 *
 *
 * This script restart steempi and all services
 *
 */

if (command_exist('apache2')) {
    system('service apache2 restart');
}

if (command_exist('lighttpd')) {
    system('service lighttpd restart');
}

if (command_exist('php7.0-fpm')) {
    system('service php7.0-fpm restart');
}