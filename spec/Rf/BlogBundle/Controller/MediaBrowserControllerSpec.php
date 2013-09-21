<?php

namespace spec\Rf\BlogBundle\Controller;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class MediaBrowserControllerSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('Rf\BlogBundle\Controller\MediaBrowserController');
    }
}
