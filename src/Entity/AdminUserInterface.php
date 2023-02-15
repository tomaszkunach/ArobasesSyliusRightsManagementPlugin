<?php

declare(strict_types=1);

namespace Arobases\SyliusRightsManagementPlugin\Entity;

interface AdminUserInterface
{
    public function getRole(): ?Role;

    public function setRole(?Role $role): void;
}
