<?php

/**
 * This file contains SteemPi\Config
 */

namespace SteemPi;

/**
 * Class Config
 *
 * @package SteemPi
 */
class Config
{
    /**
     * @var array
     */
    protected $config;

    /**
     * Config constructor.
     */
    public function __construct()
    {
        $this->config = SteemPi::getRootPath().'/conf/config.php';
    }

    /**
     * @param $name
     * @return mixed|null
     */
    public function get($name)
    {
        if (isset($this->config[$name])) {
            return $this->config[$name];
        }

        return null;
    }

    /**
     * @param string $name
     * @param string|integer|float $value
     */
    public function set($name, $value)
    {
        $this->config[$name] = $value;
    }

    /**
     * @todo
     */
    public function save()
    {

    }
}
