<?php

namespace Fuz\AppBundle\DependencyInjection;

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
     * {@inheritDoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('fuz_app');

        $rootNode
           ->children()
                ->arrayNode('twigfiddle')
                    ->isRequired()
                    ->children()
                        ->scalarNode("root_dir")
                            ->isRequired()
                            ->validate()
                                ->ifTrue(function($file) {
                                    return !is_dir($file) || !is_readable($file);
                                })
                                ->thenInvalid("Unable to read Twigfiddle's root directory at: %s")
                            ->end()
                        ->end()
                        ->scalarNode("config_path")
                            ->isRequired()
                            ->validate()
                                ->ifTrue(function($file) {
                                    return !is_file($file) || !is_readable($file);
                                })
                                ->thenInvalid("Unable to read Twigfiddle's process config file at: %s")
                            ->end()
                        ->end()
                        ->arrayNode('parameters_paths')
                            ->useAttributeAsKey('name')
                            ->prototype('scalar')
                                ->validate()
                                    ->ifTrue(function($file) {
                                        return !is_file($file) || !is_readable($file);
                                    })
                                    ->thenInvalid("Unable to read Twigfiddle's process parameters file at: %s")
                                ->end()
                            ->end()
                        ->end()
                        ->scalarNode("command")
                            ->isRequired()
                        ->end()
                        ->integerNode('max_exec_time')
                            ->defaultValue(5)
                        ->end()
                    ->end()
                ->end()
            ->end()
        ;

        return $treeBuilder;
    }
}
