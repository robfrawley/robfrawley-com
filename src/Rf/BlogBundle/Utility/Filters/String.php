<?php
/*
 * This file is part of the Rob Frawley application
 *
 * (c) Rob Frawley 2nd <rmf@robfrawley.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Rf\BlogBundle\Utility\Filters;

use Rf\BlogBundle\Utility\Core;

/**
 * String
 */
class String
{
    /**
     * @param string $string
     * @return string
     */
    public static function toNumeric($string)
    {
        return preg_replace('/[^0-9-]/i', '', $string);
    }

    /**
     * @param string $string
     * @return string
     */
    public static function toAlpha($string)
    {
        return preg_replace('/[^a-z-]/i', '', $string);
    }

    /**
     * @param string $string
     * @return string
     */
    public static function toAlphanumeric($string)
    {
        return preg_replace('/[^a-z0-9-]/i', '', $string);
    }

    /**
     * @param string $string
     * @return mixed
     */
    public static function spacesToDashes($string)
    {
        return str_replace(' ', '-', $string);
    }

    /**
     * @param string $string
     * @return mixed
     */
    public static function dashesToSpaces($string)
    {
        return str_replace('-', ' ', $string);
    }

    /**
     * @param string $string
     * @param string $function
     * @return mixed
     */
    public static function toAlphanumericAndDashes($string, $function = 'strtolower')
    {
        $string = self::spacesToDashes($string);
        $string = self::toAlphanumeric($string);

        if (null !== $function && function_exists($function)) {
            $string = Core::callFunctionOnValue($string, $function);
        }

        return $string;
    }

    /**
     * @param string $phone
     * @return string
     */
    public static function toPhoneString($phone)
    {
        $phone =
            preg_replace(
                '~.*(\d{3})[^\d]*(\d{3})[^\d]*(\d{4}).*~',
                '$1$2$3',
                $phone
            )
        ;
        $phone =
            preg_replace(
                '/[^0-9]/',
                '',
                $phone
            )
        ;

        if (strlen($phone) !== 10) {
            return null;
        }

        return $phone;
    }

    /**
     * @param string $phone
     * @return string
     */
    public static function toHumanPhoneString($phone, $format = '+1 (%A) %P-%L')
    {
        if (strlen($phone) !== 10) {
            return null;
        }

        $areaCode   = substr($phone, 0, 3);
        $prefix     = substr($phone, 3, 3);
        $lineNumber = substr($phone, 6, 4);

        $humanPhone = str_ireplace('%A', $areaCode,   $format    );
        $humanPhone = str_ireplace('%P', $prefix,     $humanPhone);
        $humanPhone = str_ireplace('%L', $lineNumber, $humanPhone);

        return $humanPhone;
    }

    /**
     * Function to attempt proper title case rules for a given string
     *
     * @author John Gruber <daringfireball.net>
     * @author David Gouch <individed.com>
     * @author Kroc Camen <camendesign.com>
     * @author Rob Frawley <rfrawley@scribenet.com>
     *
     * @see http://camendesign.com/code/title-case
     *
     * @param $title
     * @return mixed|string
     */
    public static function toTitleCase($title)
    {
        /* remove any HTML elements from string, these will be added back later */
        preg_match_all(
            '/<(code|var)[^>]*>.*?<\/\1>|<[^>]+>|&\S+;/',
            $title,
            $html,
            PREG_OFFSET_CAPTURE
        );
        $title = preg_replace(
            '/<(code|var)[^>]*>.*?<\/\1>|<[^>]+>|&\S+;/',
            '',
            $title
        );

        /* find each word, including any attached punctuation */
        preg_match_all(
            '/[\w\p{L}&`\'‘’"“\.@:\/\{\(\[<>_]+-? */u',
            $title,
            $m1,
            PREG_OFFSET_CAPTURE
        );

        /* for each word found... */
        foreach ($m1[0] as &$m2) {

            /* get the match and offset values in from matches array */
            list ($m, $i) = $m2;

            /* correct the string offset value to support *multi*-byte characters, as the PREG_OFFSET_CAPTURE preg
                value returns the *byte*-offset, this is fixed by re-counting using the *multi*-byte aware strlen */
            $i = mb_strlen(substr($title, 0, $i), 'UTF-8');

            //find words that should always be lowercase…
            //(never on the first word, and never if preceded by a colon)

            $m = (
                    $i>0 &&
                    mb_substr($title, max(0, $i-2), 1, 'UTF-8') !== ':' &&
                    !preg_match('/[\x{2014}\x{2013}] ?/u', mb_substr($title, max(0, $i-2), 2, 'UTF-8')) &&
                    preg_match('/^(a(nd?|s|t)?|b(ut|y)|en|for|i[fn]|o[fnr]|t(he|o)|vs?\.?|via)[ \-]/i', $m)
            ) ? (
                    /* change characters that are *always* lowercase */
                    mb_strtolower($m, 'UTF-8')
            ) : (
                    (
                            preg_match('/[\'"_{(\[‘“]/u', mb_substr($title, max(0, $i-1), 3, 'UTF-8')
                    ) ? (
                            /* convert first letter within brackets and other wrappers to uppercase */
                            mb_substr($m, 0, 1, 'UTF-8').
                            mb_strtoupper(mb_substr ($m, 1, 1, 'UTF-8'), 'UTF-8').
                            mb_substr($m, 2, mb_strlen($m, 'UTF-8')-2, 'UTF-8')
                    ) : (
                            (
                                    preg_match('/[\])}]/', mb_substr($title, max(0, $i-1), 3, 'UTF-8')) ||
                                    preg_match('/[A-Z]+|&|\w+[._]\w+/u', mb_substr($m, 1, mb_strlen($m, 'UTF-8')-1, 'UTF-8'))
                            ) ? (  $m
                            ) : (  mb_strtoupper(mb_substr($m, 0, 1, 'UTF-8'), 'UTF-8').
                                   mb_substr($m, 1, mb_strlen($m, 'UTF-8'), 'UTF-8')
                            )))
                );

            /* re-splice the title with the change */
            $title =
                mb_substr($title, 0, $i, 'UTF-8').
                $m.
                mb_substr($title, $i+mb_strlen($m, 'UTF-8'), mb_strlen($title, 'UTF-8'), 'UTF-8')
            ;
        }

        /* restore any html now... */
        foreach ($html[0] as &$tag) {
            $title = substr_replace($title, $tag[0], $tag[1], 0);
        }

        /* return result */
        return $title;
    }

    /**
     * @param string $str1
     * @param string $str2
     * @param null|string $encoding
     * @return int
     */
    static public function mb_strnatcasecmp($str1, $str2, $encoding = null)
    {
        if (null === $encoding) {
            $encoding = mb_internal_encoding();
        }

        return strcmp(
            mb_strtoupper($str1, $encoding),
            mb_strtoupper($str2, $encoding)
        );
    }
}