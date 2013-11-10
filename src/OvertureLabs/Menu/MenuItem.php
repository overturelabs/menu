<?php namespace OvertureLabs\Menu;

use Illuminate\Html\HtmlBuilder;
use Illuminate\Routing\UrlGenerator;

class MenuItem implements MenuItemInterface
{
    /**
     * The HTML builder instance.
     *
     * @var \Illuminate\Html\HtmlBuilder
     */
    protected $html;

    /**
     * The URL generator instance.
     *
     * @var \Illuminate\Routing\UrlGenerator  $url
     */
    protected $url;

    protected $menuItem = [];

    /**
     * Create a new menu builder instance.
     * @return void
     */
    public function __construct(HtmlBuilder $html, UrlGenerator $url)
    {
        $this->html = $html;
        $this->url = $url;
    }

    public function addLink($title, $url)
    {
        // $menuItem
    }

    public function addLinkIf($title, $url, $condition)
    {

    }

    public function addRoute($title, $route)
    {

    }

    public function addRouteIf($title, $route, $condition)
    {

    }

    public function attachSubMenu($namespace, MenuItemInterface $subMenu)
    {

    }

    public function attachSubMenuIf($namespace, MenuItemInterface $subMenu, $condition)
    {

    }

    public function getMenuItem($namespace)
    {

    }

    public function render(array $options = array())
    {
        // $options['link'] = $this->html->attributes($options);
    }

    public function toArray()
    {
        return ['test', '123'];
    }

    public function toJson($options = 0)
    {
        return json_encode(['test', '123'], $options);
    }
}
