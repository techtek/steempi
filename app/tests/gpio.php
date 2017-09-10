<?php

require dirname(dirname(__FILE__)).'/autoload.php';

use \SteemPi\GPIO;

// on
echo 'Set GPIO 1 on...';
GPIO::on(1);

echo 'wait...';
sleep(1);

$status = GPIO::read(1);

echo 'current status: ';
echo $status.PHP_EOL;

// off
echo 'Set GPIO 1 off...';
GPIO::off(1);

echo 'wait...';
sleep(1);

$status = GPIO::read(1);

echo 'current status: ';
echo $status.PHP_EOL;
