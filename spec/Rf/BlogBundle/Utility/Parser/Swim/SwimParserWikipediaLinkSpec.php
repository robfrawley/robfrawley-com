<?php

namespace spec\Rf\BlogBundle\Utility\Parser\Swim;

use PhpSpec\ObjectBehavior,
	Prophecy\Argument;
use Symfony\Component\DependencyInjection\ContainerInterface;

class SwimParserWikipediaLinkSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('Rf\BlogBundle\Utility\Parser\Swim\SwimParserWikipediaLink');
    }

    function let(ContainerInterface $container)
    {
        $this->beConstructedWith($container);
    }

    function it_can_parse_swim_wiki_markup()
    {
    	$this
    		->render('{~wiki:Wikipedia}')
    		->shouldReturn(
    			'<i class="icon-external-link a-external-icon"> </i><a class="a-external a-wikipedia a-tooltip" data-toggle="tooltip" '
    			.'data-title="Wikipedia: http://en.wikipedia.org/wiki/Wikipedia" href="http://en.wikipedia.org/wiki/Wikipedia">Wikipedia</a>'
    		)
    	;
    }

    function it_can_parse_swim_wiki_markup_with_alt_title()
    {
    	$this
    		->render('{~wiki:Wikipedia Alternate Link Title}')
    		->shouldReturn(
    			'<i class="icon-external-link a-external-icon"> </i><a class="a-external a-wikipedia a-tooltip" data-toggle="tooltip" '
    			.'data-title="Alternate Link Title: http://en.wikipedia.org/wiki/Wikipedia" href="http://en.wikipedia.org/wiki/Wikipedia">Alternate Link Title</a>'
    		)
    	;
    }
}
