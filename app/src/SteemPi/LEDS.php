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
    const BLUE = 17;

    /**
     * Green LED
     */
    const GREEN = 1;

    /**
     * Purple LED
     */
    const PURPLE = 2;

    /**
     * The LED's run one after the other
     */
    public static function runAll()
    {
        GPIO::on(self::GREEN);
        sleep(0.2);

        GPIO::off(self::GREEN);
        GPIO::on(self::PURPLE);
        sleep(0.2);

        GPIO::off(self::PURPLE);
        GPIO::on(self::BLUE);
        sleep(0.2);

        GPIO::off(self::BLUE);
    }

    /**
     * @param int $number
     */
    public static function blink($number = 3)
    {
        if (!is_numeric($number)) {
            $number = 3;
        }

        for ($i = 0; $i < $number; $i++) {
            GPIO::on(self::GREEN);
            GPIO::on(self::PURPLE);
            GPIO::on(self::BLUE);
            sleep(0.2);

            GPIO::off(self::GREEN);
            GPIO::off(self::PURPLE);
            GPIO::off(self::BLUE);
            sleep(0.2);
        }
    }
}
