<?php
/*
 * This file is part of the Rob Frawley application
 *
 * (c) Rob Frawley 2nd <rmf@robfrawley.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Rf\BlogBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * AbstractController
 */
abstract class AbstractController extends Controller
{
    /**
     * @param array $which
     * @return array
     */
    public function getServices(array $which = [])
    {
        $services = [];
        foreach ($which as $service_key) {
            $services[] = $this->getServiceSelector($service_key);
        }

        return $services;
    }

    /**
     * @param string $service_key
     * @return object
     */
    protected function getServiceSelector($service_key)
    {
        switch ($service_key) {
            case 'em':
                return $this
                    ->getDoctrine()
                    ->getManager()
                ;
            case 'request':
                return $this
                    ->getRequest()
                ;
            case 'session':
                return $this
                    ->getRequest()
                    ->getSession()
                ;
            default:
                return $this
                    ->container
                    ->get($service_key)
                ;
        }
    }
}