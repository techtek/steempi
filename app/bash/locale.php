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

$needle    = array('de_DE', 'en_EN', 'nl_NL');
$available = shell_exec('locale -a');
$available = explode("\n", trim($available));
$available = array_flip($available);

$missLanguagePack = function () use ($available, $needle) {
    foreach ($needle as $locale) {
        if (isset($available[$locale])) {
            continue;
        }

        return true;
    }

    return false;
};

if ($missLanguagePack()) {
    \cli\Colors::enable();
    \cli\line('%CI will install the language pack.%n', true);
    \cli\Colors::disable();

    system('apt-get install locales-all -y');
}
