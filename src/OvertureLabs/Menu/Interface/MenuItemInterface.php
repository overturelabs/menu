<?php namespace OvertureLabs\Menu;

interface MenuItemInterface
{
    /**
     * [__construct description]
     * @param MenuBuilderInterface $menuBuilder
     * @param [type]               $title
     * @param [type]               $url
     */
    public function __construct(MenuBuilderInterface $menuBuilder, $title = null, $attributes = array());

    /**
     * [addLink description]
     * @param [type] $title
     * @param array  $attributes
     * @param [type] $priority
     */
    public function addLink($title, $attributes = array());

    /**
     * [addLinkIf description]
     * @param [type] $title
     * @param [type] $condition
     * @param array  $attributes
     * @param [type] $priority
     */
    public function addLinkIf($title, $condition, $attributes = array());

    /**
     * [addSubMenu description]
     * @param [type]            $title
     * @param MenuItemInterface $subMenu
     * @param array             $attributes
     * @param [type] $priority
     */
    public function addSubMenu($title, MenuItemInterface $subMenu, $attributes = array());

    /**
     * [addSubMenuIf description]
     * @param [type]            $title
     * @param MenuItemInterface $subMenu
     * @param [type]            $condition
     * @param array             $attributes
     * @param [type] $priority
     */
    public function addSubMenuIf($title, MenuItemInterface $subMenu, $condition, $attributes = array());

    /**
     * [attachSubMenu description]
     * @param  [type]            $namespace
     * @param  MenuItemInterface $subMenu
     * @return [type]
     */
    public function attachSubMenu($namespace, MenuItemInterface $subMenu);

    /**
     * [attachSubMenuIf description]
     * @param  [type]            $namespace
     * @param  MenuItemInterface $subMenu
     * @param  [type]            $condition
     * @return [type]
     */
    public function attachSubMenuIf($namespace, MenuItemInterface $subMenu, $condition);

    /**
     * [getMenuItem description]
     * @param  [type] $namespace
     * @return [type]
     */
    public function getMenuItem($namespace);

    /**
     * Get all the menu items in this menu item node.
     * @return array
     */
    public function getMenuItems();

    /**
     * Get the priority of this menu item.
     * @return int
     */
    public function getPriority();

    /**
     * Get the title of this menu item.
     * @return string
     */
    public function getTitle();

    /**
     * Get the URL of this menu item.
     * @return string
     */
    public function getUrl();

    /**
     * Returns the icon class postfix for this menu item.
     *
     * E.g. <i class="icon-<icon_postfix>"></i>
     *      $attributes['icon'] = <icon_postfix>
     *
     * @return string|null
     */
    public function getIcon();

    /**
     * Check if current menu item is the active page.
     * @return boolean
     */
    public function isActive();

    /**
     * Renders the menu item with the provided renderer.
     * @param  MenuRendererInterface $menuRenderer [description]
     * @return [type]                              [description]
     */
    public function render(MenuRendererInterface $menuRenderer);

    /**
     * Returns this menu item in array form.
     * @return string
     */
    public function toArray();

    /**
     * Returns this menu item in JSON form.
     * @param  integer $options
     * @return string
     */
    public function toJson($options = 0);

    /**
     * __toString() will render the menu using the default rendering engine.
     * @return string
     */
    public function __toString();
}
