<?php

/**
 * This file contains \SteemPi\Modules\Handler
 */

namespace SteemPi\Modules;

/**
 * Class ModuleHandler
 * - Handles the modules
 * - Helps to manage modules
 *
 * @package QUI\SteemPi
 */
class Handler
{
    /**
     * return the base path of steempi
     *
     * @return string
     */
    public function getBaseDir()
    {
        return dirname(dirname(dirname(dirname(dirname(__FILE__))))).'/';
    }

    /**
     * Return the module list
     *
     * @return array
     */
    public function getModules()
    {
        $path    = $this->getBaseDir().'modules/';
        $folders = scandir($path);

        $result = array();

        foreach ($folders as $folder) {
            if ($folder == '.' || $folder == '..') {
                continue;
            }

            if (!file_exists($path.$folder.'/module.json')) {
                continue;
            }

            $result[] = new Module($path.$folder.'/module.json');
        }

        return $result;
    }
}