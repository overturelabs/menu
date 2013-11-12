<?php namespace OvertureLabs\Menu;

use Illuminate\Html\HtmlBuilder;
use Illuminate\Routing\UrlGenerator;

class MenuBuilder implements MenuBuilderInterface
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

    protected $menus = array();

    public function __construct(HtmlBuilder $html, UrlGenerator $url)
    {
        $this->html = $html;
        $this->url = $url;

        /**
         * Initialize the default menu
         */
        $this->menus['default'] = new MenuItem($this);
    }

    public function get($menuName = 'default')
    {
        if (!array_key_exists($menuName, $this->menus)) {
            $this->menus[$menuName] = new MenuItem($this);
        }

        return $this->menus[$menuName];
    }

    public function subMenu()
    {
        return new MenuItem($this);
    }

    public function getCurrentUrl()
    {
        return $this->url->current();
    }

    public function getHtmlAttributes(array $options)
    {
        if (!empty($options)) {
            return $options = $this->html->attributes($options);
        } else {
            return '';
        }
    }
}
