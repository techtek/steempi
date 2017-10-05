<?php

/**
 *   __ _                        ___ _
 *  / _\ |_ ___  ___ _ __ ___   / _ (_)
 *  \ \| __/ _ \/ _ \ '_ ` _ \ / /_)/ |
 *  _\ \ ||  __/  __/ | | | | / ___/| |
 *  \__/\__\___|\___|_| |_| |_\/    |_|
 *
 *
 * This script checks the folder chown
 *
 */

require_once 'utils.php';

$dir = dirname(dirname(dirname(__FILE__)));

// what is installed?
$apache    = command_exist('apache2');
$lightHttp = command_exist('lighttpd');

$user = false;

if ($apache) {
    $user = shell_exec(
        'ps aux | egrep \'([a|A]pache|[h|H]ttpd)\' | awk \'{print $1}\' | uniq | tail -1'
    );

    $user = trim($user);
}

if ($lightHttp) {
    $result = shell_exec(
        'ps aux | egrep \'(lighttpd)\' | awk \'{print $1}\' | uniq'
    );

    $result = explode("\n", trim($result));

    if (count($result)) {
        $result = array_filter($result, function ($entry) {
            return $entry !== 'root';
        });

        $result = array_values($result);
    }

    $user = trim($result[0]);
}

echo "Set folder permissions 'chown {$user}:{$user} to {$dir}'";
system("chown {$user}:{$user} {$dir} -R");
echo PHP_EOL;