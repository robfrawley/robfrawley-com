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
use Rf\BlogBundle\Utility\Filters\String,
    Rf\BlogBundle\Utility\Parser\ParserInterface;

/**
 * SwimParserInternalLink
 */
class SwimParserInternalLink extends SwimObserver implements ParserInterface, ContainerAwareInterface
{
    /**
     * @param null $string
     * @return mixed|null
     */
    public function render($string = null)
    {
        $router = $this
            ->getContainer()
            ->get('router')
        ;

        @preg_match_all('#{~path:([^ ]*?)( (.*?))?}#i', $string, $matches);
        if (0 < count($matches[0])) {

            for ($i = 0; $i < count($matches[0]); $i++) {

                $original = $matches[0][$i];
                $route    = $matches[1][$i];
                $title    = empty($matches[3][$i]) ? $route : $matches[3][$i];
                $url      = $router->generate($route);

                $replace  = '<a class="a-external" href="'.$url.'">'.$title.'</a>';

                $string = str_replace($original, $replace, $string);
            }
        }

        return $string;
    }
}