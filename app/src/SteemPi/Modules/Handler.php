<?php

/**
 * This file contains \SteemPi\Modules\Handler
 */

namespace SteemPi\Modules;

use SteemPi\SteemPi;

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
     * Return the number of modules
     *
     * @return int
     */
    public function getLength()
    {
        return count($this->getModules());
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

        $result  = array();
        $modules = array();

        // get the order
        $order = SteemPi::getConfig()->get('steempi', 'modulesOrder');

        if (empty($order)) {
            $order = array();
        } else {
            $order = explode(',', $order);
        }

        // read modules
        foreach ($folders as $folder) {
            if ($folder == '.' || $folder == '..') {
                continue;
            }

            if (!file_exists($path.$folder.'/module.json')) {
                continue;
            }

            $modules[] = new Module($path.$folder.'/module.json');
        }

        // order it
        $missingCheck = array();

        foreach ($order as $moduleName) {
            if (file_exists($path.$moduleName.'/module.json')) {
                $Module = new Module($path.$moduleName.'/module.json');;
                $result[] = $Module;

                $missingCheck[$Module->getName()] = true;
            }
        }

        /* @var $Module Module */
        foreach ($modules as $Module) {
            if (!isset($missingCheck[$Module->getName()])) {
                $result[] = $Module;
            }
        }

        return $result;
    }
}