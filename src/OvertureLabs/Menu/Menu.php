<?php namespace OvertureLabs\Menu;

use Illuminate\Html\HtmlBuilder;
use Illuminate\Routing\UrlGenerator;

class Menu implements MenuInterface
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

    protected $menus = [];

    public function __construct(HtmlBuilder $html, UrlGenerator $url)
    {
        $this->html = $html;
        $this->url = $url;

        /**
         * Initialize the default menu
         */
        $this->menus['default'] = new MenuItem($this->html, $this->url);
    }

    public function get($menuName = 'default')
    {
        if (!array_key_exists($menuName, $this->menus)) {
            $this->menus[$menuName] = new MenuItem($this->html, $this->url);
        }

        return $this->menus[$menuName];
    }

    public function item()
    {
        return new MenuItem($this->html, $this->url);
    }
}
