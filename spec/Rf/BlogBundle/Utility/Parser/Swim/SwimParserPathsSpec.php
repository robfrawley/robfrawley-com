<?php

namespace spec\Rf\BlogBundle\Utility\Parser\Swim;

use PhpSpec\ObjectBehavior,
	Prophecy\Argument;
use Symfony\Component\DependencyInjection\ContainerInterface,
	Symfony\Component\Routing\Router;

class SwimParserPathsSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('Rf\BlogBundle\Utility\Parser\Swim\SwimParserPaths');
    }

    function let(ContainerInterface $container, Router $router)
    {
    	$container->has('router')->willReturn(true);
    	$container->get('router')->willReturn($router);

        $this->beConstructedWith($container);
    }

    function it_can_parse_swim_path_markup()
    {
    	$this
    		->render('{~path:some_random_path}')
    		->shouldReturn(
    			'<a class="a-tooltip" data-toggle="tooltip" data-title="some_random_path: " href="">some_random_path</a>'
    		)
    	;
    }

    function it_can_parse_swim_path_markup_with_alt_title()
    {
    	$this
    		->render('{~path:some_random_path Some Random Title}')
    		->shouldReturn(
    			'<a class="a-tooltip" data-toggle="tooltip" data-title="Some Random Title: " href="">Some Random Title</a>'
    		)
    	;
    }
}
