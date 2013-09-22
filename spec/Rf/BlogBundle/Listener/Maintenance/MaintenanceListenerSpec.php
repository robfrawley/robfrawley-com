<?php

namespace spec\Rf\BlogBundle\Listener\Maintenance;

use PhpSpec\ObjectBehavior,
	Prophecy\Argument;
use Symfony\Component\DependencyInjection\ContainerInterface,
	Symfony\Component\HttpFoundation\Request,
	Symfony\Component\HttpKernel\Event\FilterControllerEvent,
	Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Rf\BlogBundle\Controller\MaintenanceController;

class MaintenanceListenerSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('Rf\BlogBundle\Listener\Maintenance\MaintenanceListener');
    }

    function let(ContainerInterface $container, Request $request, FilterControllerEvent $event, Controller $controller, MaintenanceController $maintenanceController)
    {
    	$container->getParameter('rf.maintenance_mode.enable')->willReturn(true);

    	$container->has('request')->willReturn(true);
    	$container->get('request')->willReturn($request);

    	$container->has('rf.maintenance.controller')->willReturn(true);
    	$container->get('rf.maintenance.controller')->willReturn($maintenanceController);

    	$event->getController()->willReturn([$controller]);
		$event
			->setController(
            	[$maintenanceController, 'displayMaintenanceAction']
        	)
        	->willReturn(true)
        ;

        $this->setContainer($container);
    }

    function it_can_query_maintenance_status_as_all(ContainerInterface $container, FilterControllerEvent $event)
    {
    	$container->getParameter('rf.maintenance_mode.mode')->willReturn('all');

    	$this->queryMaintenanceState($event);
    }
}
