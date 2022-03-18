<?php

declare(strict_types=1);

namespace Tests\Arobases\SyliusRightsManagementPlugin\Entity\User;

use Doctrine\ORM\Mapping as ORM;
use Arobases\SyliusRightsManagementPlugin\Entity\AdminUserTrait;
use Sylius\Component\Core\Model\AdminUser as BaseAdminUser;

/**
 * @ORM\Entity
 * @ORM\Table(name="sylius_admin_user")
 */
class AdminUser extends BaseAdminUser
{
    use AdminUserTrait;
}

