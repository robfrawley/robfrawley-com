<?php
/*
 * This file is part of the Rob Frawley application
 *
 * (c) Rob Frawley 2nd <rmf@robfrawley.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Rf\BlogBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * Configuration
 */
class Configuration implements ConfigurationInterface
{
    /**
     * {@inheritDoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode    = $treeBuilder->root('rf_blog');

        $rootNode
            ->addDefaultsIfNotSet()
            ->children()
                ->arrayNode('maintenance_mode')
                    ->children()
                        ->booleanNode('enable')
                            ->defaultFalse()
                            ->end()
                        ->enumNode('mode')
                            ->values(array('all', 'selection', null))
                            ->end()
                        ->arrayNode('bundles')
                            ->defaultValue([])
                            ->prototype('scalar')->end()
                            ->end()
                    ->end()
                ->end()
                ->arrayNode('html')
                    ->children()
                    ->scalarNode('title_pre')
                        ->defaultValue('')
                        ->end()
                    ->scalarNode('title_post')
                        ->defaultValue('Rob Frawley')
                        ->end()
                    ->scalarNode('charset')
                        ->defaultValue('UTF-8')
                        ->end()
                    ->scalarNode('lang')
                        ->defaultValue('en')
                        ->end()
                    ->end()
                ->end()
                ->scalarNode('date_format')
                    ->defaultValue('D, M j @ G:i')
                    ->end()
                ->scalarNode('brand_name')
                    ->defaultValue('Rob Frawley')
                    ->end()
                ->scalarNode('footer_copy')
                    ->defaultValue('Copyright &copy; 2013 Rob M Frawley 2nd.')
                    ->end()
                ->scalarNode('footer_credit')
                    ->defaultValue('Designed and maintained by Inserrat Technologies.')
                    ->end()
                ->end()
            ->end()
        ;

        return $treeBuilder;
    }
}
