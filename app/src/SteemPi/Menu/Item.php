<?php

/**
 * This file contains SteemPi\Menu\Item
 */

namespace SteemPi\Menu;

use SteemPi\Modules\Module;

/**
 * Class Item
 * - A MenuItem
 *
 * @package SteemPi\Menu
 */
class Item
{
    /**
     * @var Module
     */
    protected $Module;

    /**
     * @var array
     */
    protected $attributes = array(
        'icon'  => false,
        'text'  => false,
        'color' => false
    );

    /**
     * @var array
     */
    protected $cssClasses = array();

    /**
     * Menu constructor.
     *
     * @param array $params
     * @param null|Module $Module
     */
    public function __construct($params = array(), $Module = null)
    {
        if (isset($params['icon'])) {
            $this->attributes['icon'] = $params['icon'];
        }

        if (isset($params['text'])) {
            $this->attributes['text'] = $params['text'];
        }

        if (isset($params['color'])) {
            $this->attributes['color'] = $params['color'];
        }

        if ($Module instanceof Module) {
            $this->Module = $Module;
        }
    }

    /**
     * @param Module $Module
     */
    public function setModule(Module $Module)
    {
        $this->Module = $Module;
    }

    /**
     * @param $class
     */
    public function addClass($class)
    {
        $this->cssClasses[] = $class;
    }

    /**
     * @return string
     */
    public function getIcon()
    {
        if (!isset($this->attributes['icon'])) {
            return '';
        }

        $icon  = htmlspecialchars($this->attributes['icon']);
        $color = '';

        if (isset($this->attributes['color'])) {
            $color = htmlspecialchars($this->attributes['color']);
        }

        return '
            <span class="menuItem-icon" style="color: '.$color.'">
                <span class="'.$icon.'"></span>
            </span>
        ';
    }

    /**
     * Return the HTML Title
     *
     * @return string
     */
    public function getText()
    {
        if (!isset($this->attributes['text'])) {
            return '';
        }

        $text = htmlspecialchars($this->attributes['text']);
        $text = dgettext($this->Module->getName(), $text);

        return '
            <span class="menuItem-text">
                '.$text.'
            </span>
        ';
    }

    /**
     * Return the rendered HTML
     *
     * @return string
     */
    public function create()
    {
        $icon  = $this->getIcon();
        $title = $this->getText();

        $module  = '';
        $classes = '';

        if ($this->Module) {
            $module = $this->Module->getName();
        }

        if (!empty($this->cssClasses)) {
            $classes = ' class="'.implode('', $this->cssClasses).'"';
        }

        return '<a href="#!'.$module.'"'.$classes.'>
            '.$icon.'
            '.$title.'
        </a> ';
    }
}
