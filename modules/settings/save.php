<?php

if (!isset($_POST['save'])) {
    return;
}

use SteemPi\SteemPi;
use SteemPi\LEDS;

$Config  = SteemPi::getConfig();
$Modules = SteemPi::getModuleHandler();
$modules = $Modules->getModules();


unset($_POST['save']);

/**
 * SteemPi main configuration
 */

// steemit username
$steemitUsername = $_POST['steemitUsername'];
$steemitUsername = str_replace('@', '', $steemitUsername);
$steemitUsername = preg_replace('/[^a-zA-Z0-9\-]/i', '', $steemitUsername);

if (!empty($steemitUsername)) {
    $Config->set('steemit', 'username', $steemitUsername);
}

// steempi language
$Config->set('steempi', 'language', $_POST['steempiLanguage']);

// steempi module status
if (isset($_POST['modulesStatus'])) {
    $status = $_POST['modulesStatus'];
    /* @var $Module \SteemPi\Modules\Module */
    foreach ($modules as $Module) {
        if ($Module->getName() === 'settings') {
            $Module->activate();
            continue;
        }

        if (in_array($Module->getName(), $status)) {
            $Module->activate();
            continue;
        }

        $Module->deactivate();
    }
}

// steempi module order
if (isset($_POST['moduleOrder'])) {
    asort($_POST['moduleOrder']);
    $keys = array_keys($_POST['moduleOrder']);

    $Config->set('steempi', 'modulesOrder', implode(',', $keys));

    //refresh modules
    $modules = $Modules->getModules();
}

// backgrounds
if (isset($_POST['background'])) {
    $file = SteemPi::getRootPath().$_POST['background'];

    if (file_exists($file)) {
        $Config->set('steempi', 'background', $_POST['background']);
    }
}

// save config
$Config->save();

SteemPi::loadLanguage();

$configSaved = true;

LEDS::blink(3, 0.5);

/**
 * SteemPi modules configuration
 */

/* @var $Module \SteemPi\Modules\Module */
foreach ($modules as $Module) {
    $name = $Module->getName();

    if (!isset($_POST[$name])) {
        continue;
    }

    if (!is_array($_POST[$name])) {
        continue;
    }

    foreach ($_POST[$name] as $settingName => $settingValue) {
        $Module->setSetting($settingName, $settingValue);
    }

    $Module->saveSettings();
}