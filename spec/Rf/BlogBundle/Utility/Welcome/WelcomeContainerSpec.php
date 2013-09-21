<?php

namespace spec\Rf\BlogBundle\Utility\Welcome;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class WelcomeContainerSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('Rf\BlogBundle\Utility\Welcome\WelcomeContainer');
    }
}
