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
use Twig_Extension;

/**
 * AbstractExtension
 */
abstract class AbstractExtension extends Twig_Extension implements ContainerAwareInterface
{
    /**
     * @var ContainerInterface
     */
    private $container;

    /**
     * @param ContainerInterface $container
     * @return $this
     */
    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
        return $this;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return get_called_class();
    }

    /**
     * @return array
     */
    public function getFunctions()
    {
        return [];
    }
}