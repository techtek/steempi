<?php

/**
 * This file contains SteemPi\LEDS
 */

namespace SteemPi;

/**
 * Class LEDS
 * Little helper to animate the main SteemPi LEDs
 *
 * @package SteemPi
 */
class LEDS
{
    /**
     * Blue LED
     */
    const BLUE = 17; // replay

    /**
     * Green LED
     */
    const GREEN = 18; // comment

    /**
     * Purple LED
     */
    const PURPLE = 27; // unused

    /**
     * The LED's run one after the other
     *
     * @param int $delay - time to wait, default = 1 = 1 second
     */
    public static function queue($delay = 1)
    {
        if (!is_numeric($delay)) {
            $delay = 1;
        }

        GPIO::on(self::BLUE);
        sleep($delay);

        GPIO::off(self::BLUE);
        GPIO::on(self::GREEN);
        sleep($delay);

        GPIO::off(self::GREEN);
        GPIO::on(self::PURPLE);
        sleep($delay);

        GPIO::off(self::PURPLE);
    }

    /**
     * @param int $number - number to blink, default = 3
     * @param int $delay - time to wait, default = 1 = 1 second
     */
    public static function blink($number = 3, $delay = 1)
    {
        if (!is_numeric($number)) {
            $number = 3;
        }

        if (!is_numeric($delay)) {
            $delay = 1;
        }

        for ($i = 0; $i < $number; $i++) {
            GPIO::on(self::GREEN);
            GPIO::on(self::PURPLE);
            GPIO::on(self::BLUE);
            sleep($delay);

            GPIO::off(self::GREEN);
            GPIO::off(self::PURPLE);
            GPIO::off(self::BLUE);
            sleep(1);
        }
    }

    /**
     * Parse led names to the specific GPIO Pin
     *
     * @param string $name - blue, green, purple
     * @return int
     */
    public static function ledNameToGPIO($name)
    {
        $name = mb_strtolower($name);

        if ($name === 'blue') {
            return self::BLUE;
        }

        if ($name === 'green') {
            return self::GREEN;
        }

        if ($name === 'purple') {
            return self::PURPLE;
        }

        return 0;
    }
}
