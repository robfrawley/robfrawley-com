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
 * MaintenanceController
 */
class MaintenanceController extends Controller
{
    /**
     * @return Response
     */
    public function displayMaintenanceAction()
    {
        return $this->render('RfBlogBundle:Maintenance:down.html.twig');
    }
}