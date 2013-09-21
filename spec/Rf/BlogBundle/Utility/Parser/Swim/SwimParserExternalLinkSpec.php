<?php

namespace spec\Rf\BlogBundle\Utility\Parser\Swim;

use PhpSpec\ObjectBehavior,
	Prophecy\Argument;
use Symfony\Component\DependencyInjection\ContainerInterface;

class SwimParserExternalLinkSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('Rf\BlogBundle\Utility\Parser\Swim\SwimParserExternalLink');
    }

    function let(ContainerInterface $container)
    {
        $this->beConstructedWith($container);
    }

    function it_can_parse_swim_mail_markup()
    {
    	$this
    		->render('{~mail:robfrawley@robfrawley.com}')
    		->shouldReturn(
    			'<i class="icon-envelope-alt a-external-icon"> </i><a class="a-external a-tooltip" data-toggle="tooltip" '
    			.'data-title="Email robfrawley@robfrawley.com" href="mailto:robfrawley@robfrawley.com">robfrawley@robfrawley.com</a>'
    		)
    	;
    }

    function it_can_parse_swim_a_markup()
    {
    	$this
    		->render('{~a:google.com}')
    		->shouldReturn(
    			'<i class="icon-link a-external-icon"> </i><a class="a-external a-tooltip" data-toggle="tooltip" '
    			.'data-title="http://google.com: http://google.com" href="http://google.com">http://google.com</a>'
    		)
    	;
    }

    function it_can_parse_swim_a_markup_with_alt_title()
    {
    	$this
    		->render('{~a:google.com Google Inc.}')
    		->shouldReturn(
    			'<i class="icon-link a-external-icon"> </i><a class="a-external a-tooltip" data-toggle="tooltip" '
    			.'data-title="Google Inc.: http://google.com" href="http://google.com">Google Inc.</a>'
    		)
    	;
    }

    function it_can_parse_swim_a_popup_markup()
    {
    	$this
    		->render('{~a-popup:google.com}')
    		->shouldReturn(
    			'<span data-popup="true"><i class="icon-external-link a-external-icon"> </i><a class="a-external a-tooltip" '
    			.'data-toggle="tooltip" data-title="http://google.com: http://google.com" href="http://google.com">http://google.com</a></span>'
    		)
    	;
    }

    function it_can_parse_swim_a_popup_markup_with_alt_title()
    {
    	$this
    		->render('{~a-popup:google.com Google Inc.}')
    		->shouldReturn(
    			'<span data-popup="true"><i class="icon-external-link a-external-icon"> </i><a class="a-external a-tooltip" '
    			.'data-toggle="tooltip" data-title="Google Inc.: http://google.com" href="http://google.com">Google Inc.</a></span>'
    		)
    	;
    }
}