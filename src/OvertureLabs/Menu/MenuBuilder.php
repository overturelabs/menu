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
     * @var \Illuminate\Routing\UrlGenerator
     */
    protected $url;

    /**
     * The Menu renderer instance.
     * @var \OvertureLabs\Menu\MenuRendererInterface
     */
    protected $menuRenderer;

    protected $menus = array();

    public function __construct(HtmlBuilder $html, UrlGenerator $url, MenuRendererInterface $menuRenderer)
    {
        $this->html = $html;
        $this->url = $url;
        $this->menuRenderer = $menuRenderer;

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

    public function make($menuName = 'default', $options = array())
    {
        if (!array_key_exists($menuName, $this->menus)) {
            $this->menus[$menuName] = new MenuItem($this, null, $options);

            return $this->menus[$menuName];
        } else {
            /**
             * @todo Change to custom exception class
             */
            throw new Exception();
        }
    }

    public function subMenu()
    {
        return new MenuItem($this);
    }

    public function getCurrentUrl()
    {
        return $this->url->current();
    }

    public function renderAttributes(array $options)
    {
        if (!empty($options)) {
            return $options = $this->html->attributes($options);
        } else {
            return '';
        }
    }

    public function getDefaultRenderer()
    {
        return $this->menuRenderer;
    }
}
