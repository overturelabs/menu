<?php namespace OvertureLabs\Menu;

interface MenuItemInterface
{
    /**
     * [__construct description]
     * @param MenuBuilder $menuBuilder [description]
     * @param [type]      $title       [description]
     * @param [type]      $url         [description]
     */
    public function __construct(MenuBuilder $menuBuilder, $title = null, $url = null);

    /**
     * [addLink description]
     * @param [type] $title       [description]
     * @param [type] $url         [description]
     * @param array  $htmlOptions [description]
     */
    public function addLink($title, $url, $htmlOptions = array());

    /**
     * [addLinkIf description]
     * @param [type] $title       [description]
     * @param [type] $url         [description]
     * @param [type] $condition   [description]
     * @param array  $htmlOptions [description]
     */
    public function addLinkIf($title, $url, $condition, $htmlOptions = array());

    /**
     * [addSubMenu description]
     * @param [type]            $title       [description]
     * @param [type]            $url         [description]
     * @param MenuItemInterface $subMenu     [description]
     * @param array             $htmlOptions [description]
     */
    public function addSubMenu($title, $url, MenuItemInterface $subMenu, $htmlOptions = array());

    /**
     * [addSubMenuIf description]
     * @param [type]            $title       [description]
     * @param [type]            $url         [description]
     * @param MenuItemInterface $subMenu     [description]
     * @param [type]            $condition   [description]
     * @param array             $htmlOptions [description]
     */
    public function addSubMenuIf($title, $url, MenuItemInterface $subMenu, $condition, $htmlOptions = array());

    /**
     * [attachSubMenu description]
     * @param  [type]            $namespace [description]
     * @param  MenuItemInterface $subMenu   [description]
     * @return [type]            [description]
     */
    public function attachSubMenu($namespace, MenuItemInterface $subMenu);

    /**
     * [attachSubMenuIf description]
     * @param  [type]            $namespace [description]
     * @param  MenuItemInterface $subMenu   [description]
     * @param  [type]            $condition [description]
     * @return [type]            [description]
     */
    public function attachSubMenuIf($namespace, MenuItemInterface $subMenu, $condition);

    /**
     * [getMenuItem description]
     * @param  [type] $namespace [description]
     * @return [type] [description]
     */
    public function getMenuItem($namespace);

    /**
     * Renders menu item in HTML.
     * @return [type] [description]
     */
    public function render();

    /**
     * [toArray description]
     * @return [type] [description]
     */
    public function toArray();

    /**
     * [toJson description]
     * @param  integer $options [description]
     * @return [type]  [description]
     */
    public function toJson($options = 0);

    /**
     * __toString() calls render().
     * @return string Returns rendered menu.
     */
    public function __toString();
}
