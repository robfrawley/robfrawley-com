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
 * SwimParserExternalLink
 */
class SwimParserExternalLink extends SwimObserver implements ParserInterface, ContainerAwareInterface
{
    /**
     * @param null $string
     * @return mixed|null
     */
    public function render($string = null)
    {
        @preg_match_all('#{~a:([^ ]*?)( (.*?))?}#i', $string, $nodeAMatches);
        if (0 < count($nodeAMatches[0])) {

            for ($i = 0; $i < count($nodeAMatches[0]); $i++) {

                $original = $nodeAMatches[0][$i];
                $url      = $nodeAMatches[1][$i];
                if (substr($url, 0, 4) !== 'http') {
                    $url = 'http://'.$url;
                }
                $title    = empty($nodeAMatches[3][$i]) ? $url : $nodeAMatches[3][$i];
                $replace  = '<i class="icon-link a-external-icon"> </i><a class="a-external a-tooltip" data-toggle="tooltip" data-title="'.$title.': '.$url.'" href="'.$url.'">'.$title.'</a>';

                $string = str_replace($original, $replace, $string);
            }
        }

        @preg_match_all('#{~a-popup:([^ ]*?)( (.*?))?}#i', $string, $nodeAMatches);
        if (0 < count($nodeAMatches[0])) {

            for ($i = 0; $i < count($nodeAMatches[0]); $i++) {

                $original = $nodeAMatches[0][$i];
                $url      = $nodeAMatches[1][$i];
                if (substr($url, 0, 4) !== 'http') {
                    $url = 'http://'.$url;
                }
                $title    = empty($nodeAMatches[3][$i]) ? $url : $nodeAMatches[3][$i];
                $replace  = '<span data-popup="true"><i class="icon-external-link a-external-icon"> </i><a class="a-external a-tooltip" data-toggle="tooltip" data-title="'.$title.': '.$url.'" href="'.$url.'">'.$title.'</a></span>';

                $string = str_replace($original, $replace, $string);
            }
        }

        $nodeAMatches = [];
        @preg_match_all('#{~mail:([^ ]*?)( (.*?))?}#i', $string, $nodeAMatches);
        if (0 < count($nodeAMatches[0])) {

            for ($i = 0; $i < count($nodeAMatches[0]); $i++) {

                $original = $nodeAMatches[0][$i];
                $url      = $nodeAMatches[1][$i];
                $title    = empty($nodeAMatches[3][$i]) ? $url : $nodeAMatches[3][$i];
                $replace  = '<i class="icon-envelope-alt a-external-icon"> </i><a class="a-external a-tooltip" data-toggle="tooltip" data-title="Email '.$title.'" href="mailto:'.$url.'">'.$title.'</a>';

                $string = str_replace($original, $replace, $string);
            }
        }

        return $string;
    }
}