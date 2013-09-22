<?php

namespace spec\Rf\BlogBundle\Listener\Maintenance;

use PhpSpec\ObjectBehavior,
	Prophecy\Argument;
use Symfony\Component\DependencyInjection\ContainerInterface,
	Symfony\Component\HttpFoundation\Request,
	Symfony\Component\HttpKernel\Event\FilterControllerEvent,
	Symfony\Bundle\FrameworkBundle\Controller\Controller,
    Symfony\Bundle\WebProfilerBundle\Controller\ProfilerController,
    Symfony\Component\HttpFoundation\ParameterBag;
use Rf\BlogBundle\Controller\MaintenanceController;

class MaintenanceListenerSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('Rf\BlogBundle\Listener\Maintenance\MaintenanceListener');
    }

    function let(ContainerInterface $container, Request $request, ParameterBag $bag, FilterControllerEvent $event, Controller $controller, MaintenanceController $maintenanceController)
    {
        $event->stopPropagation()->willReturn(null);

    	$container->getParameter('rf.maintenance_mode.enable')->willReturn(true);

        $bag->get('_controller')->willReturn('Rf\BlogBundle\Controller\DefaultController::indexAction');

        $bag->set('namespace',  'Rf'                )->willReturn($bag);
        $bag->set('bundle',     'BlogBundle'        )->willReturn($bag);
        $bag->set('controller', 'DefaultController' )->willReturn($bag);
        $bag->set('action',     'indexAction'       )->willReturn($bag);

        $request->attributes = $bag;

    	$container->has('request')->willReturn(true);
    	$container->get('request')->willReturn($request);

    	$container->has('rf.maintenance.controller')->willReturn(true);
    	$container->get('rf.maintenance.controller')->willReturn($maintenanceController);

		$event
			->setController(
            	[$maintenanceController, 'displayMaintenanceAction']
        	)
        	->willReturn(true)
        ;

        $this->setContainer($container);
    }

    function it_can_query_maintenance_status_as_all(ContainerInterface $container, Controller $controller, FilterControllerEvent $event)
    {
    	$container->getParameter('rf.maintenance_mode.mode')->willReturn('all');

        $event->getController()->willReturn([$controller]);
    	$this->queryMaintenanceState($event);
    }

    function it_can_query_maintenance_status_as_selection(ContainerInterface $container, Controller $controller, FilterControllerEvent $event)
    {
        $container->getParameter('rf.maintenance_mode.mode')->willReturn('selection');
        $container->getParameter('rf.maintenance_mode.bundles')->willReturn(['RfBlogBundle']);

        $event->getController()->willReturn([$controller]);
        $this->queryMaintenanceState($event);
    }

    function it_can_query_maintenance_status_as_all_errors(ContainerInterface $container, Controller $controller, ProfilerController $profilerController, FilterControllerEvent $event)
    {
        $container->getParameter('rf.maintenance_mode.mode')->willReturn('all');
        $container->getParameter('rf.maintenance_mode.enable')->willReturn(false);

        $event->getController()->willReturn();
        $this->queryMaintenanceState($event);

        $event->getController()->willReturn([]);
        $this->queryMaintenanceState($event);

        $event->getController()->willReturn([$profilerController]);
        $this->queryMaintenanceState($event);

        $event->getController()->willReturn([$controller]);
        $this->queryMaintenanceState($event);
    }

    function it_can_query_maintenance_state(ContainerInterface $container, Controller $controller, ProfilerController $profilerController, FilterControllerEvent $event)
    {
        $container->getParameter('rf.maintenance_mode.mode')->willReturn('all');
        $container->getParameter('rf.maintenance_mode.enable')->willReturn(false);

        $event->getController()->willReturn();
        $this->queryMaintenanceState($event);

        $event->getController()->willReturn([]);
        $this->queryMaintenanceState($event);

        $event->getController()->willReturn([$profilerController]);
        $this->queryMaintenanceState($event);

        $event->getController()->willReturn([$controller]);
        $this->queryMaintenanceState($event);
    }
}
