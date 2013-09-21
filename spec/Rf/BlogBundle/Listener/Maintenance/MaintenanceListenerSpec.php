<?php

namespace spec\Rf\BlogBundle\Listener\Maintenance;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class MaintenanceListenerSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('Rf\BlogBundle\Listener\Maintenance\MaintenanceListener');
    }
}
