<?php

namespace spec\Rf\BlogBundle\Utility\Config;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class YamlConfigContainerSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('Rf\BlogBundle\Utility\Config\YamlConfigContainer');
    }
}
