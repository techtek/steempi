<?php

/**
 *   __ _                        ___ _
 *  / _\ |_ ___  ___ _ __ ___   / _ (_)
 *  \ \| __/ _ \/ _ \ '_ ` _ \ / /_)/ |
 *  _\ \ ||  __/  __/ | | | | / ___/| |
 *  \__/\__\___|\___|_| |_| |_\/    |_|
 *
 *
 * This script updates the locale
 *
 */

$available = array('de_DE', 'en_EN', 'nl_NL');

foreach ($available as $locale) {
    system("locale-gen {$locale}");
    system("locale-gen {$locale}.UTF-8");
}

system("update-locale");
