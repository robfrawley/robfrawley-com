<?php

namespace spec\Rf\BlogBundle\DependencyInjection;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class RfBlogExtensionSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('Rf\BlogBundle\DependencyInjection\RfBlogExtension');
    }
}
