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
     * @return OvertureLabs\Menu\MenuItem
     */
    public function get($menuName = 'default');

    /**
     * Make menu item with the provided menu name.
     * @param  string $menuName [description]
     * @param  array  $options  [description]
     * @return [type]           [description]
     */
    public function make($menuName = 'default', $options = array());

    /**
     * Returns a new MenuItem for creating sub-menus.
     *
     * @return OvertureLabs\Menu\MenuItem
     */
    public function subMenu();

    public function getCurrentUrl();

    public function renderAttributes(array $options);

    public function getDefaultRenderer();
}
