<?php namespace OvertureLabs\Menu;

interface MenuItemInterface
{
    /**
     * Constructs the menu item.
     * @param MenuBuilderInterface $menuBuilder
     * @param string               $title
     * @param array                $attributes
     */
    public function __construct(MenuBuilderInterface $menuBuilder, $title = null, $attributes = array());

    /**
     * Adds a link to current menu node.
     * @param string $title
     * @param array  $attributes
     */
    public function addLink($title, $attributes = array());

    /**
     * Adds a link to current menu node if condition is true.
     * @param string            $title
     * @param boolean|callable  $condition
     * @param array             $attributes
     */
    public function addLinkIf($title, $condition, $attributes = array());

    /**
     * Adds a sub menu to current menu node.
     * @param string            $title
     * @param MenuItemInterface $subMenu
     * @param array             $attributes
     */
    public function addSubMenu($title, MenuItemInterface $subMenu, $attributes = array());

    /**
     * Adds a sub menu to current menu node if condition is true.
     * @param string            $title
     * @param MenuItemInterface $subMenu
     * @param boolean|callable  $condition
     * @param array             $attributes
     */
    public function addSubMenuIf($title, MenuItemInterface $subMenu, $condition, $attributes = array());

    /**
     * [attachSubMenu description]
     * @param  [type]            $namespace
     * @param  MenuItemInterface $subMenu
     * @return [type]
     */
    // public function attachSubMenu($namespace, MenuItemInterface $subMenu);

    /**
     * [attachSubMenuIf description]
     * @param  [type]            $namespace
     * @param  MenuItemInterface $subMenu
     * @param  [type]            $condition
     * @return [type]
     */
    // public function attachSubMenuIf($namespace, MenuItemInterface $subMenu, $condition);

    /**
     * [getMenuItem description]
     * @param  [type] $namespace
     * @return [type]
     */
    // public function getMenuItem($namespace);

    /**
     * Get all the child menu items in this menu item node.
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
     * @param  MenuRendererInterface $menuRenderer
     * @return string
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
