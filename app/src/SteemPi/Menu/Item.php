<?php

/**
 * This file contains SteemPi\Menu\Item
 */

namespace SteemPi\Menu;

/**
 * Class Item
 * - A MenuItem
 *
 * @package SteemPi\Menu
 */
class Item
{
    /**
     * @var array
     */
    protected $attributes = array(
        'icon'  => false,
        'text'  => false,
        'color' => false
    );

    /**
     * Menu constructor.
     *
     * @param array $params
     */
    public function __construct($params = array())
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

        return '<a href="">
            '.$icon.'
            '.$title.'
        </a> ';
    }
}
