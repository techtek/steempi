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

        shell_exec('gpio export '.$gpio.' out');
        shell_exec('gpio -g write '.$gpio.' 1';);
    }

    /**
     * @param integer $gpio
     */
    public static function off($gpio)
    {
        if (!is_integer($gpio)) {
            return;
        }

        shell_exec('gpio export '.$gpio.' out');
        shell_exec('gpio -g write '.$gpio.' 0');
    }

    /**
     * Read the GPIO status
     *
     * @param integer $gpio
     * @return bool|string
     */
    public static function read($gpio)
    {
        if (!is_integer($gpio)) {
            return false;
        }

        $status = shell_exec("gpio -g read ".$gpio);
        $status = trim($status);

        return $status;
    }
}
