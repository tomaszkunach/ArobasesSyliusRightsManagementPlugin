<?php

declare(strict_types=1);

namespace Arobases\SyliusRightsManagementPlugin\Entity;

use Doctrine\ORM\Mapping as ORM;

trait AdminUserTrait
{
    /**
     * @ORM\ManyToOne(targetEntity="Arobases\SyliusRightsManagementPlugin\Entity\Role",
     *     inversedBy="adminUsers",
     *     fetch="EXTRA_LAZY",
     *      cascade={"persist", "remove"}
     * )
     */
    protected ?Role $role = null;

    /**
     * @return Role|null
     */
    public function getRole(): ?Role
    {
        return $this->role;
    }

    /**
     * @param Role|null $role
     */
    public function setRole(?Role $role): void
    {
        $this->role = $role;
    }
}
