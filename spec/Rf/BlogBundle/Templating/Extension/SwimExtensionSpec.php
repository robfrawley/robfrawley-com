<?php

namespace spec\Rf\BlogBundle\Templating\Extension;

use PhpSpec\ObjectBehavior,
    Prophecy\Argument;
use Rf\BlogBundle\Utility\Parser\Swim\SwimParser,
    Symfony\Component\DependencyInjection\ContainerInterface;

class SwimExtensionSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('Rf\BlogBundle\Templating\Extension\SwimExtension');
    }

    function let(ContainerInterface $container, SwimParser $parser)
    {
        $container
            ->has('scribe.parser.swim')
            ->willReturn(true)
        ;
        $container
            ->get('scribe.parser.swim')
            ->willReturn($parser)
        ;

        $this->beConstructedWith($container);
    }

    function it_can_swim()
    {
        $this
            ->swim(null)
            ->shouldReturn(null)
        ;
    }

    function it_can_return_filters_array()
    {
    	$this
    		->getFilters()
    		->shouldBeArray()
    	;
    }

    function it_can_get_its_name()
    {
        $this->getName()->shouldReturn('Rf\BlogBundle\Templating\Extension\SwimExtension');
    }
}
