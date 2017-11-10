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

$needle = array('de_DE.utf8', 'en_GB.utf8', 'nl_NL.utf8', 'en_US.utf8');

$available = shell_exec('locale -a');
$available = explode("\n", trim($available));
$available = array_flip($available);

$localeFile = '/etc/locale.gen';
$newLocales = false;

foreach ($needle as $locale) {
    if (isset($available[$locale])) {
        continue;
    }

    $search  = '';
    $replace = '';

    switch ($locale) {
        case 'de_DE.utf8':
            $search  = '# de_DE.UTF-8 UTF-8';
            $replace = 'de_DE.UTF-8 UTF-8';
            break;

        case 'nl_NL.utf8':
            $search  = '# nl_NL.UTF-8 UTF-8';
            $replace = 'nl_NL.UTF-8 UTF-8';
            break;

        case 'en_GB.utf8':
            $search  = '# en_GB.UTF-8 UTF-8';
            $replace = 'en_GB.UTF-8 UTF-8';
            break;

        case 'en_US.utf8':
            $search  = '# en_US.UTF-8 UTF-8';
            $replace = 'en_US.UTF-8 UTF-8';
            break;

        case 'zh_CN':
            $search  = '# zh_CN.UTF-8 UTF-8';
            $replace = 'zh_CN.UTF-8 UTF-8';
            break;

        case 'ms_MY':
            $search  = '# ms_MY.UTF-8 UTF-8';
            $replace = 'ms_MY.UTF-8 UTF-8';
            break;

        case 'id_ID':
            $search  = '# id_ID.UTF-8 UTF-8';
            $replace = 'id_ID.UTF-8 UTF-8';
            break;
    }

    if (empty($search)) {
        continue;
    }

    $newLocales = true;
    $content    = file_get_contents($localeFile);
    $content    = str_replace($search, $replace, $content);

    file_put_contents($localeFile, $content);
}

if ($newLocales) {
    \cli\Colors::enable();
    \cli\line('%CI will generate the language pack.%n', true);
    \cli\Colors::disable();

    system('locale-gen en_GB.UTF-8');
}
