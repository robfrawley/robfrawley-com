<?php

namespace spec\Rf\BlogBundle;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class RfBlogBundleSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('Rf\BlogBundle\RfBlogBundle');
    }
}
