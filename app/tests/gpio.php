<?php

require '../autoload.php';

\SteemPi\GPIO::on(1);

sleep(1);

\SteemPi\GPIO::read(1);