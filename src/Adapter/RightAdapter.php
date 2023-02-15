<?php

declare(strict_types=1);

namespace Arobases\SyliusRightsManagementPlugin\Adapter;

use Symfony\Component\DependencyInjection\ContainerInterface;

class RightAdapter
{
    private ContainerInterface $container;

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    public function getRightsFromYaml(): ?array
    {
        return $this->container->getParameter('arobases_sylius_rights_management');
    }
}
