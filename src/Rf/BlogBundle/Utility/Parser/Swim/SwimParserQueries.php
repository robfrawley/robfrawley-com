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
 * SwimParserQueries
 */
class SwimParserQueries extends SwimObserver implements ParserInterface, ContainerAwareInterface
{
    /**
     * @param null $string
     * @return mixed|null
     */
    public function render($string = null)
    {
        $renderer = $this
            ->getContainer()
            ->get('kwattro_markdown')
        ;

        @preg_match_all('#{~\?:(.*)}#i', $string, $matches);
        if (0 < count($matches[0])) {
            for ($i=0; $i<count($matches[0]); $i++) {
                $replace = '<div class="callout callout-warning"><p class="callout-header">Note</p>'.$renderer->render($matches[1][$i]).'</div>';
                $string = str_ireplace($matches[0][$i], $replace, $string);
            }
        }

        @preg_match_all('#{~\!:(.*)}#i', $string, $matches);
        if (0 < count($matches[0])) {
            for ($i=0; $i<count($matches[0]); $i++) {
                $replace = '<div class="callout callout-danger"><p class="callout-header">Key Point</p>'.$renderer->render($matches[1][$i]).'</div>';
                $string = str_ireplace($matches[0][$i], $replace, $string);
            }
        }

        @preg_match_all('#{~\-:(.*)}#i', $string, $matches);
        if (0 < count($matches[0])) {
            for ($i=0; $i<count($matches[0]); $i++) {
                $replace = '<div class="callout callout-info"><p class="callout-header">Tip</p>'.$renderer->render($matches[1][$i]).'</div>';
                $string = str_ireplace($matches[0][$i], $replace, $string);
            }
        }

        return $string;
    }
}