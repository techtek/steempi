<?php

namespace SteemPi\Modules;

use SteemPi;

/**
 * Class ModuleHandler
 * - Handles the modules
 * - Helps to manage modules
 *
 * @package QUI\SteemPi
 */
class Module
{
    /**
     * @var
     */
    protected $data = array();

    /**
     * Module constructor.
     *
     * @param $jsonFile
     * @throws SteemPi\Exception
     */
    public function __construct($jsonFile)
    {
        if (!file_exists($jsonFile)) {
            throw new SteemPi\Exception('Module has no module.json File');
        }

        $data = json_decode(file_get_contents($jsonFile), true);

        // @todo check json errors

        if ($data) {
            $this->data = $data;
        }
    }

    //region left menu

    /**
     * Extends the module the left menu?
     *
     * @return bool
     */
    public function extendsLeftMenu()
    {
        return isset($this->data['leftMenu']);
    }

    /**
     * @return SteemPi\Menu\Item
     */
    public function getLeftMenu()
    {
        return new SteemPi\Menu\Item($this->data['leftMenu']);
    }

    //endregion

    //region top menu

    /**
     * Extends the module the top menu?
     *
     * @return bool
     */
    public function extendsTopMenu()
    {
        return isset($this->data['topMenu']);
    }

    /**
     * @return SteemPi\Menu\Item
     */
    public function getTopMenu()
    {
        return new SteemPi\Menu\Item($this->data['topMenu']);
    }

    //endregion
}
