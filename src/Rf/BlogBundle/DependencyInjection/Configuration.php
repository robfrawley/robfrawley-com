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
                            ->info('Enables or disabled maintenance mode completly.')
                            ->end()
                        ->enumNode('mode')
                            ->values(array('all', 'selection', null))
                            ->info('Defines whether to apply maintenance mode globally, or based on selection')
                            ->end()
                        ->arrayNode('bundles')
                            ->defaultValue([])
                            ->info('List of all bundles to be disabled when enabled_selected is active')
                            ->prototype('scalar')->end()
                            ->end()
                    ->end()
                ->end()
                ->arrayNode('html')
                    ->children()
                    ->scalarNode('title_pre')
                        ->defaultValue('')
                        ->info('This value is added to the beginning of the HTML title value.')
                        ->end()
                    ->scalarNode('title_post')
                        ->defaultValue('Rob Frawley')
                        ->info('This value is added to the end of the HTML title value.')
                        ->end()
                    ->scalarNode('charset')
                        ->defaultValue('UTF-8')
                        ->info('The defined HTML charset.')
                        ->end()
                    ->scalarNode('lang')
                        ->defaultValue('en')
                        ->info('This value is applied as the value of data-offset-top on bootstrap affix-ed elements.')
                        ->end()
                    ->end()
                ->end()
                ->scalarNode('date_format')
                    ->defaultValue('D, M j @ G:i')
                    ->info('The default date format passed to php\'s date function.')
                    ->end()
                ->scalarNode('brand_name')
                    ->defaultValue('Rob Frawley')
                    ->info('The brand name, or header, within the main navigation.')
                    ->end()
                ->scalarNode('brand_footer')
                    ->defaultValue('&copy; 2013 Rob M Frawley 2nd')
                    ->info('The brand footer text.')
                    ->end()
                ->end()
            ->end()
        ;

        return $treeBuilder;
    }
}
