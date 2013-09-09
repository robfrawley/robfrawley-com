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
use Rf\BlogBundle\Utility\Welcome\WelcomeContainer;
use Twig_SimpleFunction;

/**
 * WelcomeExtension
 */
class WelcomeExtension extends AbstractExtension
{
    /**
     * @var WelcomeContainer|null
     */
    private $welcome;

    /**
     * @param $welcome WelcomeContainer
     */
    public function __construct(WelcomeContainer $welcome = null)
    {
        $this->welcome = $welcome;
    }

    /**
     * @return array
     */
    public function getFunctions()
    {
        return [
            new Twig_SimpleFunction('get_welcome_header', [$this->welcome, 'getHeader']),
            new Twig_SimpleFunction('get_welcome_body', [$this->welcome, 'getBody'])
        ];
    }
}