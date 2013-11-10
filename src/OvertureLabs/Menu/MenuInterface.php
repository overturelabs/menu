<?php namespace OvertureLabs\Menu;

use Illuminate\Html\HtmlBuilder;
use Illuminate\Routing\UrlGenerator;

interface MenuInterface
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
     * [get description]
     * @param  [type] $menuName [description]
     * @return OvertureLabs\Menu\MenuInterface            [description]
     */
    public function get($menuName);

    /**
     * [item description]
     * @return [type] [description]
     */
    public function item();
}
