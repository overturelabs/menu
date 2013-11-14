<?php namespace OvertureLabs\Menu\Renderer;

use OvertureLabs\Menu\MenuBuilderInterface;
use OvertureLabs\Menu\MenuItemInterface;
use OvertureLabs\Menu\MenuRendererInterface;

class BootstrapMenuRenderer implements MenuRendererInterface
{
    public static function render(MenuItemInterface $menuItem, $isRoot = false)
    {
        $html = '';
        if ($isRoot) {
            $html .= '<ul class="nav navbar-nav">';
            foreach ($menuItem->getMenuItems() as $childMenuItem) {
                $html .= static::render($childMenuItem);
            }
            $html .= '</ul>';
        } else {
            $html .= '<li class="';
            $subMenuHtml = '';

            $icon = $menuItem->getIcon();
            if (!empty($icon)) {
                $icon = '<span class="icon-'.$icon.'">&nbsp;</span>';
            }

            $childMenuItems = $menuItem->getMenuItems();
            if (!empty($childMenuItems)) {
                $html .= 'dropdown';

                $subMenuHtml .= ' class="dropdown-toggle" data-toggle="dropdown">';
                $subMenuHtml .= $icon.$menuItem->getTitle().'</a>';
                $subMenuHtml .= '<ul class="dropdown-menu animated fadeIn">';

                foreach ($menuItem->getMenuItems() as $childMenuItem) {
                    $subMenuHtml .= static::render($childMenuItem);
                }

                $subMenuHtml .= '</ul>';
            } else {
                $subMenuHtml .= '>'.$icon.$menuItem->getTitle().'</a>';
            }

            if ($menuItem->isActive()) {
                $html .= ' active';
            }

            $html .= '"><a href="'.$menuItem->getUrl().'"';

            $html .= $subMenuHtml;

            $html .= '</li>';
        }

        return $html;
    }
}
