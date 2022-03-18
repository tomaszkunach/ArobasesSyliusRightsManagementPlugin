<?php

declare(strict_types=1);

namespace Arobases\SyliusRightsManagementPlugin\Access\Checker;


use Sylius\Component\User\Model\UserInterface;

class AdminUserAccessChecker
{
    public function isUserGranted(UserInterface $adminUser, string $routeName)
    {

        dump(  $adminUser->getRole());
        dump("cc2");
//        exit;

    }
}

