<?php

declare(strict_types=1);

namespace Arobases\SyliusRightsManagementPlugin\Adapter;


use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\Yaml\Yaml;

class RightAdapter
{

    private ContainerInterface $container;

    /**
     * RightAdapter constructor.
     * @param ContainerInterface $container
     */
    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }


    public function getRightsFromYaml(): ?array
   {
       $arrayRights = $this->container->getParameter('arobases_sylius_rights_management');
       return $arrayRights;
   }
}

