<?php

namespace spec\Rf\BlogBundle\Templating\Extension;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class WelcomeExtensionSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('Rf\BlogBundle\Templating\Extension\WelcomeExtension');
    }

    function it_can_return_function_array()
    {
    	$this
    		->getFunctions()
    		->shouldBeArray()
    	;
    }
}
