<?php

namespace spec\Rf\BlogBundle\Controller;

use PhpSpec\ObjectBehavior,
	Prophecy\Argument;
use Symfony\Component\DependencyInjection\ContainerInterface,
	Symfony\Bundle\FrameworkBundle\Templating\EngineInterface,
	Symfony\Component\HttpFoundation\Response;

class MaintenanceControllerSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('Rf\BlogBundle\Controller\MaintenanceController');
    }

	function let(
		ContainerInterface $container,
        EngineInterface $templating
    ) {
        $container
        	->get('templating')
        	->willReturn($templating)
        ;

        $this->setContainer($container);
    }

    function it_should_respond_to_display_maintenance_action(
    	EngineInterface $templating,
        Response $mockResponse
    ) {
		$templating
            ->renderResponse(
                'RfBlogBundle:Maintenance:down.html.twig',
                array(),
                null
            )
            ->willReturn($mockResponse)
        ;

    	$response = $this->displayMaintenanceAction();

    	$response->shouldHaveType(
    		'Symfony\Component\HttpFoundation\Response'
    	);
    }
}
