<?php

require dirname(dirname(__FILE__)).'/autoload.php';

use \SteemPi\GPIO;

$gpio = 1;

if (isset($argv[1])) {
    $gpio = (int)$argv[1];
}

// on
echo 'Set GPIO '.$gpio.' on...';
GPIO::on(1);

echo 'wait...';
sleep(1);

$status = GPIO::read($gpio);

echo 'current status: ';
echo $status.PHP_EOL;

// off
echo 'Set GPIO '.$gpio.' off...';
GPIO::off($gpio);

echo 'wait...';
sleep(1);

$status = GPIO::read($gpio);

echo 'current status: ';
echo $status.PHP_EOL;
