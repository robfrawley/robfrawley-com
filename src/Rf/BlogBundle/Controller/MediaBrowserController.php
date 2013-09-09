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
 * MediaBrowserController
 */
class MediaBrowserController extends AbstractController
{
    /**
     * @var string|null
     */
    private $root = null;

    /**
     * @param $root string|null
     * @return $this
     */
    public function setRoot($root = null)
    {
        $this->root = $root;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getRoot()
    {
        return $this->root;
    }

    /**
     * na files browser
     */
    public function naAction()
    {
        list($em, $request) = $this->getServices(['em', 'request']);

        $route = $request->get('_route');

        $welcome_repo  = $em->getRepository('RfBlogBundle:Welcome');
        $welcome       = $welcome_repo->findOneForContext($route);

        $this->setRoot(__DIR__.'/../../../../app/data/na/');

        return $this->render(
            'RfBlogBundle:MediaBrowser:na.html.twig', [ 
                
            ]
        );
    }
}
