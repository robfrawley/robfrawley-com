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

/**
 * DefaultController
 */
class DefaultController extends AbstractController
{
    public function indexAction()
    {
        list($em) = $this->getServices(['em']);

        $repository    = $em->getRepository('RfBlogBundle:Welcome');
        $welcome       = $repository->findAll();
        $welcome_count = count($welcome);
        $welcome_i     = mt_rand(0, $welcome_count-1);

        return $this->render(
            'RfBlogBundle:Default:index.html.twig',
            [ 'welcome' => $welcome[$welcome_i] ]
        );
    }
}
