<?php

namespace spec\Rf\BlogBundle\Utility\Config;

use PhpSpec\ObjectBehavior,
	Prophecy\Argument;
use Symfony\Component\DependencyInjection\ContainerInterface;

class YamlConfigContainerSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('Rf\BlogBundle\Utility\Config\YamlConfigContainer');
    }

	function let(ContainerInterface $container)
    {
        $container
            ->getParameter('a.key')
            ->willReturn('A Value')
        ;
        
        $this->setContainer($container);
    }

    function it_can_get_a_parameter_value_by_key()
    {
    	$this
    		->get('a.key')
    		->shouldReturn('A Value')
    	;
    }

    function it_cannot_set_a_parameter_value_by_key()
    {
    	$this
    		->shouldThrow('\Exception')
    		->duringSet('another-key', 'another-value')
    	;
    }
}
