#!/usr/bin/php
<?php

/**
 *   __ _                        ___ _
 *  / _\ |_ ___  ___ _ __ ___   / _ (_)
 *  \ \| __/ _ \/ _ \ '_ ` _ \ / /_)/ |
 *  _\ \ ||  __/  __/ | | | | / ___/| |
 *  \__/\__\___|\___|_| |_| |_\/    |_|
 *
 *
 * SteemPi CLI
 *
 * @author dehenne
 */

if (php_sapi_name() != 'cli') {
    die('Must run from command line');
}

// error_reporting(E_ALL | E_ERROR | E_PARSE);
error_reporting(E_ERROR | E_PARSE);

ini_set('display_errors', 1);
ini_set('log_errors', 0);

require_once 'app/autoload.php';

$strict    = in_array('--strict', $_SERVER['argv']);
$Arguments = new \cli\Arguments(compact('strict'));


$Arguments->addFlag(array('help', 'h'), 'Show this help screen');
$Arguments->addFlag(array('version', 'v'), 'Display the version');


$Arguments->addOption(
    'update',
    'Update SteemPi'
);

$Arguments->addOption(
    'change-branch',
    'Change between the branches from SteemPi: dev or master'
);


$Arguments->parse();
$arguments = json_decode($Arguments->asJSON(), true);

$needHelp = function () use ($arguments) {
    if (isset($arguments['help']) && $arguments['help']) {
        return true;
    }

    foreach ($arguments as $name => $value) {
        if ($value === null) {
            return false;
        }

        if (!empty($value)) {
            return false;
        }
    }

    return true;
};

$displayHelp = function () use ($Arguments) {
    $logo = "

  Welcome to

   __ _                        ___ _
  / _\ |_ ___  ___ _ __ ___   / _ (_)
  \ \| __/ _ \/ _ \ '_ ` _ \ / /_)/ |
  _\ \ ||  __/  __/ | | | | / ___/| |
  \__/\__\___|\___|_| |_| |_\/    |_|

    ";

    \cli\Colors::enable();
    \cli\line('%C'.$logo.'%n', true);
    \cli\Colors::disable();

    echo PHP_EOL;
    echo $Arguments->getHelpScreen();
    echo PHP_EOL.PHP_EOL;
    exit;
};


if ($needHelp()) {
    $displayHelp();
}

if ($arguments['update'] || $arguments['update'] === null) {
    include 'app/bash/update.php';
    exit;
}

if (isset($arguments['change-branch'])) {
    system('git fetch');
    switch ($arguments['change-branch']) {
        case 'dev':
            system('git reset --hard origin/dev');
            exit;

        case 'master':
            system('git reset --hard origin/master');
            exit;

        default:
            \cli\Colors::enable();
            \cli\line('Please use %C%5dev%n or %C%5master%n as value for --change-branch%n', true);
            \cli\Colors::disable();
            exit;
    }
}

$displayHelp();