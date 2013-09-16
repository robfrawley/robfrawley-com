<?php
/*
 * This file is part of the Rob Frawley application
 *
 * (c) Rob Frawley 2nd <rmf@robfrawley.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Rf\BlogBundle\Utility\Parser\Swim;

use Symfony\Component\DependencyInjection\ContainerAwareInterface,
    Symfony\Component\DependencyInjection\ContainerInterface;
use Rf\BlogBundle\Utility\Container\ContainerAwareTrait,
    Rf\BlogBundle\Utility\Filters\String,
    Rf\BlogBundle\Utility\Subject\AbstractSubject,
    Rf\BlogBundle\Utility\Parser\ParserInterface;

/**
 * SwimParser
 */
class SwimParser extends AbstractSubject implements ParserInterface, ContainerAwareInterface
{
    use ContainerAwareTrait {
        ContainerAwareTrait::__construct as __traitConstruct;
    }

    /**
     * @var string
     */
    private $string = '';

    /**
     * @var bool
     */
    private $rendered = false;

    /**
     * @var array
     */
    private $config = ['ExcludeLevel', 'Paths', 'WikipediaLink', 'ExternalLink', 'InternalLink', 'Queries', 'ExcludeLevel', 'Markdown'];

    /**
     * @var array
     */
    private $parsers = [];

    /**
     * @param ContainerInterface $container
     * @param array $config
     */
    public function __construct(ContainerInterface $container = null, array $config = null)
    {
        $this->__traitConstruct($container);
        $this->configure($config);
        $this->setup();
    }

    /**
     * @param array $config
     * @return $this
     */
    public function configure(array $config = null)
    {
        if ($config !== null) {
            $this->config = (array)$config;
        }

        $this->setup(true);

        return $this;
    }

    /**
     * @param boolean $new
     * @return $this
     */
    private function setup($new = false)
    {
        if ($new === true) {
            $this->parsers = [];
        }

        foreach ($this->config as $i => $v) {
            if (!array_key_exists($v, $this->parsers) || !$this->parsers[$v] instanceof ParserInterface) {
                $obj = '\Rf\BlogBundle\Utility\Parser\Swim\SwimParser'.$v;
                $this->parsers[$v] = new $obj($this->container);
            }

            $this->attach($this->parsers[$v], true);
        }

        return $this;
    }

    /**
     * @param null $string
     * @return $this
     */
    public function setContent($string = null)
    {
        $this->string = $string;

        return $this;
    }

    /**
     * @return string
     */
    public function getContent()
    {
        return $this->string;
    }

    /**
     * @param null $string
     * @return string
     */
    public function render($string = null)
    {
        if ($string !== null) {
            $this->setContent($string);
        }
        if ($string !== null || $this->rendered === false) {
            $this->notify();
            $this->rendered = true;
        }

        return $this->getContent();
    }
}