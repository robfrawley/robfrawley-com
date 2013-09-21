<?php

namespace spec\Rf\BlogBundle\Utility\Parser\Swim;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class SwimParserSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('Rf\BlogBundle\Utility\Parser\Swim\SwimParser');
    }

    function let($container)
    {
        $container->beADoubleOf('\Symfony\Component\DependencyInjection\Container');
        $this->beConstructedWith($container);
    }

    function it_can_set_config()
    {
    	$this
    		->configure(['ExternalLink'])
    		->shouldReturn($this)
    	;
    }

    function it_can_ignore_lack_of_config()
    {
    	$this
    		->configure()
    		->shouldReturn($this)
    	;
    }

    function it_can_set_and_get_content()
    {
    	$this
    		->setContent('content')
    		->shouldReturn($this)
    	;
    	$this
    		->getContent()
    		->shouldReturn('content')
    	;
    }

}
