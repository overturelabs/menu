<?php namespace OvertureLabs\Menu;

use Illuminate\Html\HtmlBuilder;
use Illuminate\Routing\UrlGenerator;

interface MenuItemInterface
{
    const ROOT = 'menu';
    const TITLE = 'title';
    const LINK = 'link';
    const SUBMENU_TITLE = 'submenu_title';
    const SUBMENU_LINK = 'submenu_link';

    /**
     * Create a new menu item instance.
     *
     * @param  \Illuminate\Routing\UrlGenerator  $url
     * @param  \Illuminate\Html\HtmlBuilder  $html
     * @return void
     */
    public function __construct(HtmlBuilder $html, UrlGenerator $url);

    /**
     * [addLink description]
     * @param [type] $title [description]
     * @param [type] $url   [description]
     */
    public function addLink($title, $url);

    /**
     * [addLinkIf description]
     * @param [type] $title     [description]
     * @param [type] $url       [description]
     * @param [type] $condition [description]
     */
    public function addLinkIf($title, $url, $condition);

    /**
     * [addRoute description]
     * @param [type] $title [description]
     * @param [type] $route [description]
     */
    public function addRoute($title, $route);

    /**
     * [addRouteIf description]
     * @param [type] $title     [description]
     * @param [type] $route     [description]
     * @param [type] $condition [description]
     */
    public function addRouteIf($title, $route, $condition);

    /**
     * [attachSubMenu description]
     * @param  [type]            $namespace [description]
     * @param  MenuItemInterface $subMenu   [description]
     * @return [type]                       [description]
     */
    public function attachSubMenu($namespace, MenuItemInterface $subMenu);

    /**
     * [attachSubMenuIf description]
     * @param  [type]            $namespace [description]
     * @param  MenuItemInterface $subMenu   [description]
     * @param  [type]            $condition [description]
     * @return [type]                       [description]
     */
    public function attachSubMenuIf($namespace, MenuItemInterface $subMenu, $condition);

    /**
     * [getMenuItem description]
     * @param  [type] $namespace [description]
     * @return [type]            [description]
     */
    public function getMenuItem($namespace);

    /**
     * [toArray description]
     * @return [type] [description]
     */
    public function toArray();

    /**
     * [toJson description]
     * @param  integer $options [description]
     * @return [type]           [description]
     */
    public function toJson($options = 0);
}
