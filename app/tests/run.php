<?php

require dirname(dirname(__FILE__)).'/autoload.php';

use \SteemPi\GPIO;

for ($i = 0, $len = 20; $i < $len; $i++) {
    echo "Start {$i} ...";
    GPIO::on(1);

    echo 'wait...';
    sleep(1);
    GPIO::off(1);
    echo PHP_EOL;
}

echo "DONE".PHP_EOL;