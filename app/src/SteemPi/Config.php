<?php

/**
 * This file contains SteemPi\Config
 */

namespace SteemPi;

use Piwik\Ini\IniReader;
use Piwik\Ini\IniWriter;

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
    protected $config = array();

    /**
     * @var bool|string
     */
    protected $file = false;

    /**
     * Config constructor.
     */
    public function __construct()
    {
        $file = SteemPi::getRootPath().'/etc/conf.ini.php';

        if (!file_exists($file)) {
            return;
        }

        $Reader = new IniReader();

        $this->file   = $file;
        $this->config = $Reader->readFile($file);
    }

    /**
     * Return a init file
     *
     * @param string $group
     * @param string|bool $name - optional
     * @return mixed|null
     */
    public function get($group, $name = false)
    {
        if ($name === false) {
            if (isset($this->config[$group])) {
                return $this->config[$group];
            }

            return null;
        }

        if (isset($this->config[$group][$name])) {
            return $this->config[$group][$name];
        }

        return null;
    }

    /**
     * @param string $group - name of the ini group
     * @param string|bool $name - optional
     * @param string|integer|float $value
     */
    public function set($group, $name, $value)
    {
        if ($name === false) {
            $this->config[$group] = $value;

            return;
        }

        $this->config[$group][$name] = $value;
    }

    /**
     * Write the data to the config file
     */
    public function save()
    {
        $Writer = new IniWriter();
        $config = $Writer->writeToString($this->config);

        $result = ';<?php exit; ?>'.PHP_EOL.PHP_EOL;
        $result .= $config;

        file_put_contents($this->file, $result);
    }
}
