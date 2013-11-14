<?php namespace OvertureLabs\Menu;

use Exception;

class MenuItem implements MenuItemInterface
{
    protected $menuBuilder;

    protected $title = null;

    protected $url = '#';

    protected $icon = null;

    protected $priority = 0;

    protected $childMenuItems = array();

    /**
     * Create a new menu builder instance.
     * @return void
     */
    public function __construct(MenuBuilderInterface $menuBuilder, $title = null, $attributes = array())
    {
        $this->menuBuilder = $menuBuilder;
        $this->title = trim($title);

        $url = $this->getUrlFromAttributes($attributes);

        if ($url !== false) {
            $this->url = $url;
        }

        $icon = $this->getIconFromAttributes($attributes);

        if ($icon !== false) {
            $this->icon = $icon;
        }

        $priority = $this->getPriorityFromAttributes($attributes);

        if ($priority !== false) {
            $this->priority = $priority;
        }
    }

    public function addLink($title, $attributes = array())
    {
        $title = trim($title);

        $url = $this->getUrlFromAttributes($attributes);

        if ($url !== false) {
            $this->url = $url;
        }

        $icon = $this->getIconFromAttributes($attributes);

        if ($icon !== false) {
            $this->icon = $icon;
        }

        $priority = $this->getPriorityFromAttributes($attributes);

        if ($priority !== false) {
            $this->priority = $priority;
        }

        /**
         * Let's check if menu item already exists.
         * If it doesn't we'll create it.
         */
        if (!array_key_exists($title, $this->childMenuItems)) {
            $this->childMenuItems[$title] = new MenuItem($this->menuBuilder, $title, $attributes);
        } else {
            /**
             * @todo Change to custom exception class
             */
            throw new Exception();
        }

        /**
         * Priority attached to this link.
         * We need to sort the menu based on priority.
         */
        if ($priority > 0) {
            $this->sortChildMenus();
        }

        return $this;
    }

    public function addLinkIf($title, $condition, $attributes = array())
    {
        return $this->isConditionTrue($condition) ? $this->addLink($title, $attributes) : $this;
    }

    public function addSubMenu($title, MenuItemInterface $subMenu, $attributes = array())
    {
        $this->addLink($title, $attributes);
        $this->childMenuItems[$title]->childMenuItems = $subMenu->childMenuItems;
    }

    public function addSubMenuIf($title, MenuItemInterface $subMenu, $condition, $attributes = array())
    {
        return $this->isConditionTrue($condition) ? $this->addSubMenu($title, $subMenu, $attributes) : $this;
    }

    private function isConditionTrue($condition)
    {
        if (is_bool($condition)) {
            return ($condition === true);
        } elseif (is_callable($condition)) {
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

    // public function attachSubMenu($namespace, MenuItemInterface $subMenu)
    // {
    //     $menuItem = $this->getMenuItem($namespace);

    //     $menuItem->childMenuItems = array_merge($menuItem->childMenuItems, $subMenu->childMenuItems);

    //     return $this;
    // }

    // public function attachSubMenuIf($namespace, MenuItemInterface $subMenu, $condition)
    // {
    //     return $this->isConditionTrue($condition) ? $this->attachSubMenu($namespace, $subMenu) : $this;
    // }

    // public function getMenuItem($namespace)
    // {
    //     $namespace = trim($namespace);

    //     if (preg_match('/^([^\.]*)(?:\.([^\.]+(?:\.[^\.]+)*))*$/', $namespace, $segments)) {
    //         if (array_key_exists($segments[1], $this->childMenuItems)) {
    //             if (empty($segments[2])) {
    //                 return $this->childMenuItems[$segments[1]];
    //             } else {
    //                 return $this->childMenuItems[$segments[1]]->getMenuItem($segments[2]);
    //             }
    //         }
    //     }

    //     /**
    //      * @todo Change to custom exception class
    //      */
    //     throw new Exception('Provided namespace, '.$namespace.', does not exists!');
    // }

    public function getMenuItems()
    {
        return $this->childMenuItems;
    }

    public function getPriority()
    {
        return $this->priority;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function getUrl()
    {
        return $this->url;
    }

    public function getIcon()
    {
        return $this->icon;
    }

    public function isActive()
    {
        return $this->menuBuilder->getCurrentUrl() === $this->getUrl();
    }

    public function render(MenuRendererInterface $menuRenderer)
    {
        return $menuRenderer->render($this, true);
    }

    public function toArray()
    {
        $childMenuItems = array();

        foreach ($this->childMenuItems as $title => $childMenuItem) {
            $childMenuItems[$title] = $childMenuItem->toArray();
        }

        $array = [
            'title' => $this->title,
            'url'   => $this->url,
            'icon'  => $this->icon,
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
        return $this->render($this->menuBuilder->getDefaultRenderer());
    }

    private function getIconFromAttributes(array $attributes)
    {
        if (array_key_exists('icon', $attributes)) {
            /**
             * We only want the postfix identifier for this icon.
             * @todo Does w3c specify any formats for HTML class identifiers?
             *
             * E.g. <i class="icon-<icon_postfix>"></i>
             *      $attributes['icon'] = <icon_postfix>
             */
            return preg_replace('/\s+/', '', $attributes['icon']);
        } else {
            return false;
        }
    }

    private function getUrlFromAttributes(array $attributes)
    {
        if (array_key_exists('url', $attributes)) {
            $url = filter_var($attributes['url'], FILTER_SANITIZE_URL);

            if (!filter_var($url, FILTER_VALIDATE_URL)) {
                /**
                 * @todo Change to custom exception class
                 */
                throw new Exception();
            } else {
                return $url;
            }
        } else {
            return false;
        }
    }

    private function getPriorityFromAttributes(array $attributes)
    {
        if (array_key_exists('priority', $attributes)) {
            $priority = $attributes['priority'];

            if (!is_int($priority) || $priority < 0) {
                /**
                 * @todo Change to custom exception class
                 */
                throw new Exception();
            } else {
                return $priority;
            }
        } else {
            return false;
        }
    }

    private function sortChildMenus()
    {
        uasort($this->childMenuItems, function (MenuItemInterface $a, MenuItemInterface $b) {

            var_dump($a->getPriority().' && '.$b->getPriority());
            if ($a->getPriority() == $b->getPriority()) {
                return 0;
            }

            return ($a->getPriority() < $b->getPriority()) ? -1 : 1;
        });
    }
}
