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

use Symfony\Component\DependencyInjection\ContainerBuilder,
    Symfony\Component\DependencyInjection\Loader;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;

/**
 * RfBlogExtension
 */
class RfBlogExtension extends Extension
{
    /**
     * {@inheritDoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $configuration = new Configuration();
        $config = $this->processConfiguration(
            $configuration, 
            $configs
        );

        $container->setParameter(
            'rf.maintenance_mode.enable',
            $config['maintenance_mode']['enable']
        );
        $container->setParameter(
            'rf.maintenance_mode.mode',
            $config['maintenance_mode']['mode']
        );
        $container->setParameter(
            'rf.maintenance_mode.bundles',
            $config['maintenance_mode']['bundles']
        );
        $container->setParameter(
            'rf.html.title_pre',
            $config['html']['title_pre']
        );
        $container->setParameter(
            'rf.html.title_post',
            $config['html']['title_post']
        );
        $container->setParameter(
            'rf.html.lang',
            $config['html']['lang']
        );
        $container->setParameter(
            'rf.html.charset',
            $config['html']['charset']
        );
        $container->setParameter(
            'rf.date_format',
            $config['date_format']
        );
        $container->setParameter(
            'rf.brand_name',
            $config['brand_name']
        );
        $container->setParameter(
            'rf.brand_footer',
            $config['brand_footer']
        );
        $container->setParameter(
            'rf.date_format',
            $config['date_format']
        );

        $loader = new Loader\YamlFileLoader(
            $container, 
            new FileLocator(__DIR__.'/../Resources/config')
        );

        $loader->load('config.yml');
        $loader->load('services.yml');
    }
}
