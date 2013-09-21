<?php

namespace spec\Rf\BlogBundle\Command;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class SystemCommandSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('Rf\BlogBundle\Command\SystemCommand');
    }
}
