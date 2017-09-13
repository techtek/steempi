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
     * @var null
     */
    protected static $Locale = null;

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

    /**
     * Load the current localization
     */
    public static function loadLanguage()
    {
        $lang = self::getConfig()->get('steempi', 'language');

        if (!$lang) {
            $lang = 'en_GB';
        }

        switch ($lang) {
            case 'en_EN':
                $lang = 'en_GB';
                break;
        }

        setlocale(
            6,
            $lang.".UTF-8",
            $lang.".utf8",
            $lang.".UTF8",
            $lang.".utf-8",
            $lang
        );

        putenv("LANG=".$lang.'.utf8');

        bindtextdomain('steemPi', './locale');
        bind_textdomain_codeset('steemPi', 'UTF-8');

        $modules = self::getModuleHandler()->getModules();

        /* @var $Module Modules\Module */
        foreach ($modules as $Module) {
            $localeDir = $Module->getDir().'locale';

            if (is_dir($localeDir)) {
                bindtextdomain($Module->getName(), $localeDir);
                bind_textdomain_codeset($Module->getName(), 'UTF-8');
            }
        }

        textdomain('steemPi');

        \Locale::setDefault(str_replace('_', '-', $lang));
    }
}
