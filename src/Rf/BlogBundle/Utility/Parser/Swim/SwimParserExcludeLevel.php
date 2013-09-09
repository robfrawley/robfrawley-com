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
 * SwimParserBlockLevel
 */
class SwimParserExcludeLevel extends SwimObserver implements ParserInterface, ContainerAwareInterface
{
    /**
     * @var boolean
     */
    protected $firstPass = true;

    /**
     * @var array
     */
    protected $excludes = [];

    /**
     * @param null $string
     * @return mixed|null
     */
    public function render($string = null)
    {
        return $this->firstPass === true ?
            $this->renderFirstPass($string) : $this->renderSecondPass($string)
        ;
    }

    /**
     * @param $string string|null
     * @return string
     */
    public function renderFirstPass($string = null)
    {
        @preg_match_all('#{~ex:start}((.*?\n?)*?){~ex:end}#i', $string, $matches);

        for ($i = 0; $i < count($matches[0]); $i++) {
            $original = $matches[0][$i];
            $content  = $matches[1][$i];
            $anchor   = md5($content.$i);
            $replace  = '{~ex:anchor:'.$anchor.'}';

            $string = str_replace($original, $replace, $string);

            $this->excludes[$anchor] = $content;
        }

        $this->firstPass = false;

        return $string;
    }

    /**
     * @param $string string
     * @return string
     */
    public function renderSecondPass($string = null)
    {
        $matches = [];
        $pattern = '#{~ex:anchor:(.*?)}#i';
        @preg_match_all($pattern, $string, $matches);

        for ($i = 0; $i < count($matches[0]); $i++) {
            $original = $matches[0][$i];
            $md5      = $matches[1][$i];
            $replace  = $this->excludes[$md5];

            $string = str_replace($original, $replace, $string);
        }
        
        return $string;
    }
}