<?php namespace OvertureLabs\Menu;

use Exception;

class MenuItem implements MenuItemInterface
{
    protected $menuBuilder;

    protected $title;

    protected $url;

    protected $htmlOptions;

    protected $childMenuItems = [];

    /**
     * Create a new menu builder instance.
     * @return void
     */
    public function __construct(MenuBuilder $menuBuilder, $title = null, $url = null, $htmlOptions = array())
    {
        $this->menuBuilder = $menuBuilder;
        $this->title = $title;
        $this->url = $url;
        $this->htmlOptions = $htmlOptions;
    }

    public function addLink($title, $url, $htmlOptions = array())
    {
        $title = trim($title);
        $url = trim($url);

        if ($url !== '#') {
            $url = filter_var($url, FILTER_SANITIZE_URL);

            if (!filter_var($url, FILTER_VALIDATE_URL)) {
                /**
                 * @todo Change to custom exception class
                 */
                throw new Exception();
            }
        }

        if (!array_key_exists($title, $this->childMenuItems)) {
            $this->childMenuItems[$title] = new MenuItem($this->menuBuilder, $title, $url, $htmlOptions);
        } else {
            /**
             * @todo Change to custom exception class
             */
            throw new Exception();
        }

        return $this;
    }

    public function addLinkIf($title, $url, $condition, $htmlOptions = array())
    {
        return $this->isConditionTrue($condition) ? $this->addLink($title, $url, $htmlOptions) : $this;
    }

    public function addSubMenu($title, $url, MenuItemInterface $subMenu, $htmlOptions = array())
    {
        $this->addLink($title, $url, $htmlOptions);
        $this->childMenuItems[$title]->childMenuItems = $subMenu->childMenuItems;
    }

    public function addSubMenuIf($title, $url, MenuItemInterface $subMenu, $condition, $htmlOptions = array())
    {
        return $this->isConditionTrue($condition) ? $this->addSubMenu($title, $url, $subMenu, $htmlOptions) : $this;
    }

    private function isConditionTrue($condition)
    {
        if (is_bool($condition)) {
            return ($condition === true);
        } else if (is_callable($condition)) {
            return call_user_func($condition);
        } else {
            /**
             * It's neither a boolean nor callable!
             *
             * @todo Change to custom exception class
             */
            throw new Exception();
        }
    }

    public function attachSubMenu($namespace, MenuItemInterface $subMenu)
    {
        $menuItem = $this->getMenuItem($namespace);

        $menuItem->childMenuItems = array_merge($menuItem->childMenuItems, $subMenu->childMenuItems);

        return $this;
    }

    public function attachSubMenuIf($namespace, MenuItemInterface $subMenu, $condition)
    {
        return $this->isConditionTrue($condition) ? $this->attachSubMenu($namespace, $subMenu) : $this;
    }

    public function getMenuItem($namespace)
    {
        $namespace = trim($namespace);

        if (preg_match('/^([^\.]*)(?:\.([^\.]+(?:\.[^\.]+)*))*$/', $namespace, $segments)) {
            if (array_key_exists($segments[1], $this->childMenuItems)) {
                if (empty($segments[2])) {
                    return $this->childMenuItems[$segments[1]];
                } else {
                    return $this->childMenuItems[$segments[1]]->getMenuItem($segments[2]);
                }
            }
        }

        /**
         * @todo Change to custom exception class
         */
        throw new Exception('Provided namespace, '.$namespace.', does not exists!');
    }

    public function render()
    {
        return $this->recursiveRender($this->menuBuilder->getCurrentUrl(), true);
    }

    protected function recursiveRender($currentUrl, $isRoot = false)
    {
        $html = '';

        if ($isRoot) {
            $html = '<ul class="nav">';

            foreach ($this->childMenuItems as $childMenuItem) {
                $html .= $childMenuItem->recursiveRender($currentUrl);
            }

            $html .= '</ul>';
        } else {
            $html .= '<li class="';
            $subMenuHtml = '';

            $icon = '';
            if (array_key_exists('icon', $this->htmlOptions)) {
                $icon = preg_replace('/\s+/', '', $this->htmlOptions['icon']);
                $icon = filter_var($icon, FILTER_SANITIZE_STRING);
                $icon = '<i class="icon-'.$icon.'">&nbsp;</i>';
            }

            if (!empty($this->childMenuItems)) {
                $html .= 'dropdown-submenu';

                $subMenuHtml .= ' class="dropdown-toggle" data-toggle="dropdown">';
                $subMenuHtml .= $icon.$this->title.'</a>';
                $subMenuHtml .= '<ul class="dropdown-menu animated fadeIn">';

                foreach ($this->childMenuItems as $childMenuItem) {

                    $subMenuHtml .= $childMenuItem->recursiveRender($currentUrl);
                }

                $subMenuHtml .= '</ul>';
            } else {
                $subMenuHtml .= '>'.$icon.$this->title.'</a>';
            }

            if ($this->url == $currentUrl) {
                $html .= ' active';
            }

            $html .= '"><a href="'.$this->url.'"';


            $html .= $subMenuHtml;

            $html .= '</li>';
        }

        return $html;
    }

    public function toArray()
    {
        $childMenuItems = [];

        foreach ($this->childMenuItems as $title => $childMenuItem) {
            $childMenuItems[$title] = $childMenuItem->toArray();
        }

        $array = [
            'title' => $this->title,
            'url'   => $this->url,
            'childMenuItems' => $childMenuItems
        ];

        return $array;
    }

    public function toJson($options = 0)
    {
        return json_encode($this->toArray(), $options);
    }

    public function __toString()
    {
        // return $this->render();
    }
}
