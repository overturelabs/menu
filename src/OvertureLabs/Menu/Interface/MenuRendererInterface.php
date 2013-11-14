<?php namespace OvertureLabs\Menu;

interface MenuRendererInterface
{
    /**
     * Renders menu item in HTML.
     * @return string
     */
    public static function render(MenuItemInterface $menuItem, $isRoot = false);
}
