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
    private $other = [];

    /**
     * @param ContainerInterface $container
     */
    public function __construct(ContainerInterface $container = null)
    {
        $this->__traitConstruct($container);
        
        $this->attach($excludeBlock = new SwimParserExcludeLevel($container));
        $this->attach(new SwimParserWikipediaLink($container));
        $this->attach(new SwimParserExternalLink($container));
        $this->attach(new SwimParserInternalLink($container));
        $this->attach(new SwimParserQueries($container));
        $this->attach($excludeBlock, true);

        $this->attach(new SwimParserMarkdown($container));
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