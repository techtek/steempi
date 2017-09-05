<?php

namespace SteemPi;

/**
 * Class GPIO
 * - Connection for the GPIO Pins
 *
 * @package SteemPi
 */
class GPIO
{
    /**
     * @param integer $gpio
     */
    public static function on($gpio)
    {
        if (!is_integer($gpio)) {
            return;
        }

        system('gpio mode '.$gpio.' out');
        system('gpio write '.$gpio.' 1');
    }

    /**
     * @param integer $gpio
     */
    public static function off($gpio)
    {
        if (!is_integer($gpio)) {
            return;
        }

        system('gpio mode '.$gpio.' out');
        system('gpio write '.$gpio.' 0');
    }
}
