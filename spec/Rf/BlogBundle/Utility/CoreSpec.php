<?php
/*
 * This file is part of the Rob Frawley application
 *
 * (c) Rob Frawley 2nd <rmf@robfrawley.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace spec\Rf\BlogBundle\Utility;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

/**
 * CoreSpec
 */
class CoreSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('Rf\BlogBundle\Utility\Core');
    }

    function it_calls_a_php_function()
    {
    	self
    		::callFunctionOnValue('STRING', 'strtolower')
    		->shouldReturn('string')
    	;
    	$this
    		->shouldThrow('\BadFunctionCallException')
    		->duringCallFunctionOnValue('STRING', 'thisFunctionDoesNotExist')
    	;
    }
}
