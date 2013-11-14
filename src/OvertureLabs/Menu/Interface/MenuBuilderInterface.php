<?php namespace OvertureLabs\Menu;

use Illuminate\Html\HtmlBuilder;
use Illuminate\Routing\UrlGenerator;

interface MenuBuilderInterface
{
    /**
     * Create a new menu builder instance.
     *
     * @param  \Illuminate\Routing\UrlGenerator
     * @param  \Illuminate\Html\HtmlBuilder
     * @param  \OvertureLabs\Menu\MenuRendererInterface
     * @return void
     */
    public function __construct(HtmlBuilder $html, UrlGenerator $url, MenuRendererInterface $menuRenderer);

    /**
     * Gets the menu item defined by the provided menu name.
     * If menu item doesn't exist, the menu builder creates
     * the menu item and returns it.
     *
     * @param  string $menuName
     * @return OvertureLabs\Menu\MenuItemInterface
     */
    public function get($menuName = 'default');

    /**
     * Make menu item with the provided menu name.
     * @param  string $menuName
     * @param  array  $options
     * @return OvertureLabs\Menu\MenuItemInterface
     */
    public function make($menuName = 'default', $options = array());

    /**
     * Returns a new MenuItem for creating sub-menus.
     *
     * @return OvertureLabs\Menu\MenuItemInterface
     */
    public function subMenu();

    /**
     * Get current URL.
     * @return string
     */
    public function getCurrentUrl();

    /**
     * Get the default rendering engine specified by the config file.
     * @return \OvertureLabs\Menu\MenuRendererInterface
     */
    public function getDefaultRenderer();
}
