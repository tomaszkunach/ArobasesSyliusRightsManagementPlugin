<?php

declare(strict_types=1);

namespace Arobases\SyliusRightsManagementPlugin\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

final class Configuration implements ConfigurationInterface
{
    /**
     * @psalm-suppress UnusedVariable
     */
    public function getConfigTreeBuilder(): TreeBuilder
    {
        $treeBuilder = new TreeBuilder('arobases_sylius_rights_management');
        $rootNode = $treeBuilder->getRootNode();


        $rootNode
                ->children()
                    ->arrayNode('rights')
                        ->arrayPrototype()
                            ->children()
                                ->scalarNode('name')->end()
                                ->scalarNode('redirect_to')->end()
                                ->arrayNode('routes')
                                   ->scalarPrototype()->end()
                                ->end()
                                ->arrayNode('excludes')
                                    ->scalarPrototype()->end()
                                ->end()
                            ->end()
                        ->end()
                    ->end()
                ->end()
        ;

        return $treeBuilder;
    }
}
