<?php

/**
 * This file contains SteemPi\SteemPi
 */

namespace SteemPi;

/**
 * Class SteemPi
 * - Central handler class
 *
 * @package SteemPi
 */
class SteemPi
{
    /**
     * @var Config
     */
    protected static $Config = null;

    /**
     * @var Modules\Handler
     */
    protected static $Modules = null;

    /**
     * @return string
     */
    public static function getRootPath()
    {
        return dirname(dirname(dirname(dirname(__FILE__))));
    }

    /**
     * Return the global config
     *
     * @return Config
     */
    public static function getConfig()
    {
        if (self::$Config === null) {
            self::$Config = new Config();
        }

        return self::$Config;
    }

    /**
     * Return the global module handler
     *
     * @return Modules\Handler
     */
    public static function getModuleHandler()
    {
        if (self::$Modules === null) {
            self::$Modules = new Modules\Handler();
        }

        return self::$Modules;
    }
}
