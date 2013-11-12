<?php namespace OvertureLabs\Menu;

use Illuminate\Html\HtmlBuilder;
use Illuminate\Routing\UrlGenerator;

interface MenuBuilderInterface
{
    const ROOT = 'menu';
    const TITLE = 'title';
    const LINK = 'link';
    const SUBMENU_TITLE = 'submenu_title';
    const SUBMENU_LINK = 'submenu_link';

    /**
     * Create a new menu builder instance.
     *
     * @param  \Illuminate\Routing\UrlGenerator  $url
     * @param  \Illuminate\Html\HtmlBuilder  $html
     * @return void
     */
    public function __construct(HtmlBuilder $html, UrlGenerator $url);

    /**
     * Gets the menu item defined by the provided menu name.
     * If menu item doesn't exist, the menu builder creates
     * the menu item and returns it.
     *
     * @param  string $menuName
     * @return OvertureLabs\Menu\MenuItem
     */

    public function get($menuName = 'default');

    /**
     * Returns a new MenuItem for creating sub-menus.
     *
     * @return OvertureLabs\Menu\MenuItem
     */
    public function subMenu();

    public function getCurrentUrl();
}
