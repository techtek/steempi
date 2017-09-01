<?php

/**
 * Autoload
 */
$Loader = require dirname(dirname(__FILE__)).'/vendor/autoload.php';
$Loader->setPsr4('SteemPi\\', __DIR__.'/src/SteemPi/');

/**
 * Localization
 */

$lang = \SteemPi\SteemPi::getConfig()->get('steempiLanguage');

if (!$lang) {
    $lang = 'en_US';
}

switch ($lang) {
    case 'en_EN':
        $lang = 'en_US';
        break;

}

setlocale(
    6,
    $lang.".UTF-8",
    $lang.".utf8",
    $lang.".UTF8",
    $lang.".utf-8",
    $lang
);

putenv("LANG=".$lang);

bindtextdomain('steemPi', './locale');
bind_textdomain_codeset('steemPi', 'UTF-8');

$modules = \SteemPi\SteemPi::getModuleHandler()->getModules();

/* @var $Module SteemPi\Modules\Module */
foreach ($modules as $Module) {
    $localeDir = $Module->getDir().'locale';

    if (is_dir($localeDir)) {
        bindtextdomain($Module->getName(), $localeDir);
        bind_textdomain_codeset($Module->getName(), 'UTF-8');
    }
}

textdomain('steemPi');
