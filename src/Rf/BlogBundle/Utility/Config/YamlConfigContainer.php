<?php
/*
 * This file is part of the Rob Frawley application
 *
 * (c) Rob Frawley 2nd <rmf@robfrawley.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Rf\BlogBundle\Utility\Config;

use Symfony\Component\DependencyInjection\ContainerInterface,
    Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Exception;

/**
 * YamlConfigContainer
 */
class YamlConfigContainer extends AbstractConfigContainer
{
    /**
     * @param $key string
     * @return mixed
     */
    public function get($key)
    {
        return $this
            ->container
            ->getParameter($key)
        ;
    }

    /**
     * @param $key string
     * @param $value mixed
     * @return $this
     * @throws Exception
     */
    public function set($key, $value)
    {
        throw new Exception('YAML configuration is static and cannot be set during runtime.');
    }
}