<?php

namespace spec\Rf\BlogBundle\DependencyInjection;

use PhpSpec\ObjectBehavior,
	Prophecy\Argument;

class ConfigurationSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('Rf\BlogBundle\DependencyInjection\Configuration');
    }
}
