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
 * SwimParserWikipediaLink
 */
class SwimParserWikipediaLink extends SwimObserver implements ParserInterface, ContainerAwareInterface
{
    /**
     * @param null $string
     * @return mixed|null
     */
    public function render($string = null)
    {
        @preg_match_all('#{~wiki:([^ ]*?)( (.*?))?}#i', $string, $nodeWikiMatches);
        if (0 < count($nodeWikiMatches[0])) {

            for ($i = 0; $i < count($nodeWikiMatches[0]); $i++) {

                $original = $nodeWikiMatches[0][$i];
                $key      = $nodeWikiMatches[1][$i];
                $url      = 'http://en.wikipedia.org/wiki/'.urlencode($key);
                $title    = empty($nodeWikiMatches[3][$i]) ? $key : $nodeWikiMatches[3][$i];
                $replace  = '<i class="icon-external-link a-external-icon"> </i><a class="a-external a-wikipedia a-tooltip" data-toggle="tooltip" data-title="'.$title.': '.$url.'" href="'.$url.'">'.$title.'</a>';

                $string = str_replace($original, $replace, $string);
            }
        }

        return $string;
    }
}