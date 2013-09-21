<?php
/*
 * This file is part of the Rob Frawley application
 *
 * (c) Rob Frawley 2nd <rmf@robfrawley.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace spec\Rf\BlogBundle\Utility\Filters;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

/**
 * StringSpec
 */
class StringSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('Rf\BlogBundle\Utility\Filters\String');
    }

	function it_converts_string_to_numeric()
	{
		self
			::toNumeric('something with number (12345) and letters')
			->shouldReturn('12345')
		;
	}

	function it_converts_string_to_alpha()
	{
		self
			::toAlpha('something with number (12345) and letters')
			->shouldReturn('somethingwithnumberandletters')
		;
	}

    function it_converts_string_to_alphanumeric()
    {
    	self
    		::toAlphanumeric('abcdef012345!#%&("')
    		->shouldReturn('abcdef012345')
    	;
    }

    function it_converts_spaces_to_dashes()
    {
    	self
    		::spacesToDashes('this is a string')
    		->shouldReturn('this-is-a-string')
    	;
    }

    function it_converts_dashes_to_spaces()
    {
    	self
    		::dashesToSpaces('this-is-a-string')
    		->shouldReturn('this is a string')
    	;
    }

    function it_converts_string_to_alphanumeric_and_spaces_to_dashes()
    {
    	self
    		::toAlphanumericAndDashes('this string has $p3ci@1 chars')
    		->shouldReturn('this-string-has-p3ci1-chars')
    	;
    }

    function it_parses_phone_string_to_10_digit_phone_string()
    {
    	$return = '1231231234';
    	self
    		::toPhoneString('+1 (123) 123-1234')
    		->shouldReturn($return)
    	;
       	self
    		::toPhoneString('+1 231231234')
    		->shouldReturn($return)
    	;
    	self
    		::toPhoneString('123-123-1234')
    		->shouldReturn($return)
    	;
       	self
    		::toPhoneString('(123) 1231234')
    		->shouldReturn($return)
    	;
       	self
    		::toPhoneString('1231231234')
    		->shouldReturn($return)
    	;
       	self
    		::toPhoneString('231234')
    		->shouldReturn(null)
    	;
    }

    function it_parses_phone_string_to_human_phone_string()
    {
    	self
    		::toHumanPhoneString('123456')
    		->shouldReturn(null)
    	;
    	self
    		::toHumanPhoneString('1112223333')
    		->shouldReturn('+1 (111) 222-3333')
    	;
    	self
    		::toHumanPhoneString('1112223333', '%A')
    		->shouldReturn('111')
    	;
    	self
    		::toHumanPhoneString('1112223333', '%P')
    		->shouldReturn('222')
    	;
    	self
    		::toHumanPhoneString('1112223333', '%L')
    		->shouldReturn('3333')
    	;
    }

    function it_converts_string_to_title_case()
    {
    	self
    		::toTitleCase('this Is a test of Title case')
    		->shouldReturn('This Is a Test of Title Case')
    	;
    	self
    		::toTitleCase('the Article [a] should be Uppercase in brackets')
    		->shouldReturn('The Article [A] Should Be Uppercase in Brackets')
    	;
    	self
    		::toTitleCase('<h1>tags should be ignored</h1>')
    		->shouldReturn('<h1>Tags Should Be Ignored</h1>')
    	;
    }

    function it_compares_two_multibyte_natural_case_strings()
    {
		$this
			::mb_strnatcasecmp('A', 'A')
			->shouldEqual(0)
		;
    }
}
