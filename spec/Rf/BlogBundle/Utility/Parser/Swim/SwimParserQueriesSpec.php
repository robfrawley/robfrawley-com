<?php

namespace spec\Rf\BlogBundle\Utility\Parser\Swim;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class SwimParserQueriesSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('Rf\BlogBundle\Utility\Parser\Swim\SwimParserQueries');
    }
}
