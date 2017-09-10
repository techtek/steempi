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

        shell_exec('gpio mode '.$gpio.' out');
        shell_exec('gpio write '.$gpio.' 1');
    }

    /**
     * @param integer $gpio
     */
    public static function off($gpio)
    {
        if (!is_integer($gpio)) {
            return;
        }

        shell_exec('gpio mode '.$gpio.' out');
        shell_exec('gpio write '.$gpio.' 0');
    }


    public static function read($gpio)
    {
        if (!is_integer($gpio)) {
            return false;
        }

        $status = shell_exec("gpio read ".$gpio);
        var_dump($status);

        return $status[0];
    }
}
