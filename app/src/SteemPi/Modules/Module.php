<?php

/**
 * This file contains SteemPi\Modules\Module
 */

namespace SteemPi\Modules;

use Piwik\Ini\IniReader;
use Piwik\Ini\IniWriter;
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
     * Module name
     *
     * @var string
     */
    protected $name = '';

    /**
     * @var array
     */
    protected $settings = array();

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

        // name
        $this->name = basename(dirname($jsonFile));

        // data
        $data = json_decode(file_get_contents($jsonFile), true);


        // @todo check json errors

        if ($data) {
            $this->data = $data;
        }

        // config
        $configFile = SteemPi\SteemPi::getRootPath().'/etc/'.$this->name.'.ini.php';

        if (file_exists($configFile)) {
            $Reader         = new IniReader();
            $this->settings = $Reader->readFile($configFile);
        }
    }

    /**
     * Return the module name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Return the module title
     * Its the locale title from the module, not the name
     *
     * @return string
     */
    public function getTitle()
    {
        $title = $this->getName().' title';

        if ($this->data['title']) {
            $title = $this->data['title'];
        }

        return dgettext($this->getName(), $title);
    }

    /**
     * Return the module icon
     *
     * @return string
     */
    public function getIcon()
    {
        if (!isset($this->data['icon']) || empty($this->data['icon'])) {
            return '<img src="/app/images/logo.svg" />';
        }

        $name = $this->getName();
        $icon = htmlspecialchars($this->data['icon']);

        if (strpos($icon, 'fa-') === false) {
            $path = '/modules/'.$name.'/'.$icon;
            $html = '<img src="'.$path.'" />';
        } else {
            $html = '<span class="'.$icon.'"></span>';
        }

        return $html;
    }

    /**
     * Return the module path
     */
    public function getDir()
    {
        return SteemPi\SteemPi::getRootPath().'/modules/'.$this->getName().'/';
    }

    //region activation

    /**
     * Return the active status from the module
     *
     * @return bool
     */
    public function isActive()
    {
        return (bool)SteemPi\SteemPi::getConfig()->get('modules', $this->getName());
    }

    /**
     * Activate the module
     */
    public function activate()
    {
        $Config = SteemPi\SteemPi::getConfig();
        $Config->set('modules', $this->getName(), 1);
    }

    /**
     * Deactivate the module
     */
    public function deactivate()
    {
        $Config = SteemPi\SteemPi::getConfig();
        $Config->set('modules', $this->getName(), 0);
    }

    //endregion

    //region settings

    /**
     * Return the wanted setting of the module
     *
     * @param string $group
     * @param bool $name
     * @return mixed|null
     */
    public function getSetting($group, $name = false)
    {
        if (!isset($this->settings[$group])) {
            return null;
        }

        if ($name === false) {
            return $this->settings[$group];
        }

        if (isset($this->settings[$group][$name])) {
            return $this->settings[$group][$name];
        }

        return null;
    }

    /**
     * Set a setting to the module
     * - if it is to be saved, saveSettings still needs to be executed
     *
     * @param string $name
     * @param string $value
     */
    public function setSetting($name, $value)
    {
        if (!isset($this->data['allowedSettings'])) {
            return;
        }

        $allowed = array_flip($this->data['allowedSettings']);

        if (!isset($allowed[$name])) {
            return;
        }

        $value = str_replace('"', '', $value);
        $value = trim($value);

        $this->settings[$this->getName()][$name] = $value;
    }

    /**
     * Save the module settings
     */
    public function saveSettings()
    {
        $name = $this->getName();

        if ($name === 'settings') {
            return;
        }

        if (!isset($this->data['allowedSettings'])) {
            return;
        }

        $config  = SteemPi\SteemPi::getRootPath().'/etc/'.$name.'.ini.php';
        $allowed = $this->data['allowedSettings'];

        if (!is_array($allowed)) {
            return;
        }

        if (!file_exists($config)) {
            file_put_contents($config, '');
        }

        $Writer  = new IniWriter();
        $content = $Writer->writeToString($this->settings);

        $result = ';<?php exit; ?>'.PHP_EOL.PHP_EOL;
        $result .= $content;

        file_put_contents($config, $result);
    }

    /**
     * Has the module template setting data?
     *
     * @return bool
     */
    public function hasSettingsTemplateData()
    {
        if (!isset($this->data['settings'])) {
            return false;
        }

        if (!count($this->data['settings'])) {
            return false;
        }

        return true;
    }

    /**
     * Return the template setting data
     *
     * @return array|mixed
     */
    public function getSettingsTemplateData()
    {
        if (!isset($this->data['settings'])) {
            return array();
        }

        if (is_array($this->data['settings'])) {
            return $this->data['settings'];
        }

        return array();
    }

    /**
     * Return the settings html
     *
     * @return string
     */
    public function renderSettings()
    {
        $settings = $this->getSettingsTemplateData();
        $name     = $this->getName();
        $result   = '';

        $getType = function ($data) {
            if (!isset($data['type'])) {
                return 'text';
            }

            switch ($data['type']) {
                // text
                case 'text':
                case 'search':
                case 'password':
                case 'tel':
                case 'url':
                case 'email':

                    // numbers
                case 'number':
                case 'range':

                    // select
                case 'radio':
                case 'checkbox':
                    return $data['type'];
                    break;
            }

            return 'text';
        };

        foreach ($settings as $setting) {
            if (!isset($setting['name'])) {
                continue;
            }

            $text      = '';
            $fieldName = $name.'['.$setting['name'].']';

            // text
            if (isset($setting['text'])) {
                $text = htmlspecialchars(dgettext($name, $setting['text']));
            }

            // value
            $value = $this->getSetting($name, $setting['name']);

            if ($value === null) {
                $value = '';
            }

            // html
            $html = '<label>';
            $html .= '<span class="label">'.$text.'</span>';
            $html .= '<input type="'.$getType($setting).'" name="'.$fieldName.'" value="'.$value.'"/>';
            $html .= '</label>';

            $result .= $html;
        }

        return $result;
    }



    //endregion

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
        return new SteemPi\Menu\Item($this->data['leftMenu'], $this);
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
        return new SteemPi\Menu\Item($this->data['topMenu'], $this);
    }

    //endregion
}
