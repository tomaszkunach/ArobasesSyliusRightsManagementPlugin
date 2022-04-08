<?php

namespace  Arobases\SyliusRightsManagementPlugin\Menu;

use Sylius\Bundle\UiBundle\Menu\Event\MenuBuilderEvent;

final class AdminMenuListener
{
    public function addAdminMenuItems(MenuBuilderEvent $event): void
    {
        $menu = $event->getMenu();
        $menu->getChild('configuration')->addChild('roles',[
            'route' => 'arobases_sylius_rights_management_plugin_admin_role_index'
        ])->setLabel('arobases_sylius_rights_management_plugin.menu.admin.roles')->setLabelAttribute('icon', 'users');
    }
}
