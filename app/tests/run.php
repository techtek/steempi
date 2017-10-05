<?php

require dirname(dirname(__FILE__)).'/autoload.php';

use \SteemPi\GPIO;

for ($i = 0, $len = 30; $i < $len; $i++) {
    echo "Start {$i} ...";
    GPIO::on($i);

    echo 'wait...';
    sleep(1);
    GPIO::off($i);
    echo PHP_EOL;
}

echo "DONE".PHP_EOL;