<?php

namespace Umanit\ContentPublicationBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * This is the class that validates and merges configuration from your app/config files.
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/configuration.html}
 */
class Configuration implements ConfigurationInterface
{
    /**
     * {@inheritdoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder('umanit_content_publication');
        $rootNode = $treeBuilder->getRootNode();

        $rootNode
            ->children()
                ->arrayNode('disabled_firewalls')
                    ->info("Defines the firewalls where the filter should be disabled (ex: admin)")
                    ->prototype('scalar')->end()->defaultValue([])
                ->end()
            ->end()
        ;

        return $treeBuilder;
    }
}
