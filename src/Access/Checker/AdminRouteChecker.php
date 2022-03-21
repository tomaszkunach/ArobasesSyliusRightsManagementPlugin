<?php

declare(strict_types=1);

namespace Arobases\SyliusRightsManagementPlugin\Access\Checker;


class AdminRouteChecker
{

//    public function isAdminRoute(string $routeName, string $routeSection): bool
    public function isAdminRoute(string $routeName): bool
    {
        if( strpos($routeName, 'admin') !== false ){
            return true;
        }
        return false;
    }
}

