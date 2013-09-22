<?php
/*
 * This file is part of the Scribe World Application.
 *
 * (c) Scribe Inc. <scribe@scribenet.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Rf\BlogBundle\Listener\Maintenance;

use Symfony\Component\DependencyInjection\ContainerAwareInterface,
    Symfony\Component\DependencyInjection\ContainerInterface,
    Symfony\Component\HttpKernel\Event\FilterControllerEvent;
use Symfony\Bundle\WebProfilerBundle\Controller\ProfilerController;

/**
 * MaintenanceListener
 */
class MaintenanceListener implements ContainerAwareInterface
{
    /**
     * @var ContainerInterface|null
     */
    private $container = null;

    /**
     * @param $container ContainerInterface
     */
    public function __construct(ContainerInterface $container = null)
    {
        $this->setContainer($container);
    }

    /**
     * @param $container ContainerInterface
     * @return $this
     */
    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
        return $this;
    }

    /**
     * @param $event FilterControllerEvent
     * @return void
     */
    public function queryMaintenanceState(FilterControllerEvent $event)
    {
        $request = $this
            ->container
            ->get('request')
        ;
        $maintenanceEnabled = $this
            ->container
            ->getParameter('rf.maintenance_mode.enable')
        ;
        $maintenanceMode = $this
            ->container
            ->getParameter('rf.maintenance_mode.mode')
        ;
        
        $controller = $event->getController();

        if (!is_array($controller) || !count($controller) > 0) {
            return;
        }

        if ($controller[0] instanceof ProfilerController) {
            return;
        }

        if ($maintenanceEnabled !== true) {
            return;
        }

        switch ($maintenanceMode) {
            case 'all':
                $this->handleMaintenanceController($event);
                break;

            case 'selection':
            default:
                $this->determineMaintenanceState($event);
        }
    }

    private function determineMaintenanceState(FilterControllerEvent $event)
    {
        $maintenanceBundles = $this
            ->container
            ->getParameter('rf.maintenance_mode.bundles')
        ;
        list(,,,,$qualifiedBundle) = $this->handleBundleExtraction();

        foreach ($maintenanceBundles as $bundle) {
            if ($qualifiedBundle === $bundle) {
                $this->handleMaintenanceController($event);
            }
        }
    }

    /**
     * @return array
     */
    private function handleBundleExtraction()
    {
        $request = $this
            ->container
            ->get('request')
        ;
        $matches    = array();
        $controller = $request
            ->attributes
            ->get('_controller')
        ;
        preg_match('#([^\\\]*)\\\([^\\\]*)\\\Controller\\\([^:]*)::(.*)#i', $controller, $matches);

        $namespace  = isset($matches[1]) ? $matches[1] : null;
        $bundle     = isset($matches[2]) ? $matches[2] : null;
        $controller = isset($matches[3]) ? $matches[3] : null;
        $action     = isset($matches[4]) ? $matches[4] : null;

        $request->attributes->set('namespace',  $namespace );
        $request->attributes->set('bundle',     $bundle    );
        $request->attributes->set('controller', $controller);
        $request->attributes->set('action',     $action    );

        return [
            $namespace,
            $bundle,
            $controller,
            $action,
            $namespace.$bundle
        ];
    }

    /**
     * @param $event FilterControllerEvent
     */
    protected function handleMaintenanceController(FilterControllerEvent $event)
    {
        $event->stopPropagation();

        $maintenanceController = $this->container->get('rf.maintenance.controller');

        $event->setController(
            [$maintenanceController, 'displayMaintenanceAction']
        );
    }
}