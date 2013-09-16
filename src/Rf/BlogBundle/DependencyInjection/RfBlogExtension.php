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
use Symfony\Component\DependencyInjection\ContainerInterface,
    Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Rf\BlogBundle\Utility\Container\ContainerAwareTrait;

/**
 * RfBlogExtension
 */
class RfBlogExtension extends Extension implements ContainerAwareInterface
{
    use ContainerAwareTrait {
        __construct as __constructContainer;
    }

    /**
     * {@inheritDoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $this->__constructContainer($container);

        $configuration = new Configuration();
        $config = $this->processConfiguration(
            $configuration, 
            $configs
        );

        $this->processConfigToParameter($config);

        $loader = new Loader\YamlFileLoader(
            $container, 
            new FileLocator(__DIR__.'/../Resources/config')
        );

        $loader->load('config.yml');
        $loader->load('services.yml');
    }

    /**
     * @param $indices array
     * @param $pre string
     * @param $sep string
     * @return string
     */
    private function buildConfigIndex(array $indices = [], $pre = 'rf', $sep = '.') 
    {
        $returnIndex = $pre;
        for ($i = 0; $i < count($indices); $i++) {
            if ($indices[$i] === '') continue;
            $returnIndex .= $sep . $indices[$i];
        }

        return $returnIndex;
    }

    /**
     * @param $config array
     * @return $this
     */
    private function processConfigToParameter(array $config = [], $index = '')
    {
        foreach ($config as $key => $value) {
            if (is_array($value)) {
                $this->processConfigToParameter($value, $key);
                continue;
            }

            $newIndex = $this->buildConfigIndex([$index, $key]);
            $this
                ->container
                ->setParameter(
                    $newIndex,
                    $value
                )
            ;
        }

        return $this;
    }
}
