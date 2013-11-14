<?php namespace OvertureLabs\Menu;

interface MenuRendererInterface
{
    /**
     * Renders menu item in HTML.
     * @param  MenuItemInterface $menuItem
     * @param  boolean           $isRoot
     * @return string
     */
    public static function render(MenuItemInterface $menuItem, $isRoot = false);
}
