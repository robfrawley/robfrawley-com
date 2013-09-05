<?php
/*
 * This file is part of the Rob Frawley application
 *
 * (c) Rob Frawley 2nd <rmf@robfrawley.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Rf\BlogBundle\Templating\Extension;

use Symfony\Component\DependencyInjection\ContainerInterface,
    Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Rf\BlogBundle\Utility\Config\YamlConfigContainer;

/**
 * YamlConfigExtension
 */
class YamlConfigExtension extends AbstractExtension
{
    /**
     * @param $config YamlConfigExtension
     */
    public function __construct(YamlConfigContainer $config)
    {
        $this->config = $config;
    }

    /**
     * @param $key string
     * @param $container ContainerInterface|null
     * @return mixed
     */
    public function getConfig($key, $container = null)
    {
        return $this->config->get($key);
    }

    /**
     * @return array
     */
    public function getFunctions()
    {
        return [
            'get_config' => new \Twig_Function_Method(
                $this,
                'getConfig',
                ['is_safe' => ['html']]
            )
        ];
    }
}