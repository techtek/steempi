<?php

if (!isset($_REQUEST['led'])) {
    exit;
}

require dirname(dirname(__FILE__)).'/autoload.php';

use SteemPi\GPIO;
use SteemPi\LEDS;

$gpio = LEDS::ledNameToGPIO($_REQUEST['led']);

GPIO::on($gpio);
sleep(1);
GPIO::off($gpio);
