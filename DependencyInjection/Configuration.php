<?php

namespace Evelabs\PhealNGBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * This is the class that validates and merges configuration from your app/config files
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html#cookbook-bundles-extension-config-class}
 */
class Configuration implements ConfigurationInterface
{
    /**
     * {@inheritdoc}
     */
    public function getConfigTreeBuilder()
    {

        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('evelabs_pheal');
        $rootNode
            ->children()
                ->scalarNode('cache_dir')->isRequired()->cannotBeEmpty()->end()
                ->scalarNode('user_agent')->defaultValue('')->end()
                ->scalarNode('logger')->defaultValue('logger')->end()
                ->booleanNode('verify_peer')->defaultValue(true)->end()
                ->booleanNode('use_post')->defaultValue(false)->end()
                ->booleanNode('keep_alive')->defaultValue(false)->end()
                ->integerNode('timeout')->defaultValue(20)->end()
            ->end();

        // Here you should define the parameters that are allowed to
        // configure your bundle. See the documentation linked above for
        // more information on that topic.

        return $treeBuilder;
    }
}
