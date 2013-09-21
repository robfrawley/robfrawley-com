<?php

namespace spec\Rf\BlogBundle\Entity;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class PostSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('Rf\BlogBundle\Entity\Post');
    }
}
