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

        $post_repo = $em->getRepository('RfBlogBundle:Post');
        $posts     = $post_repo->findLatest(3);

        return $this->render(
            'RfBlogBundle:Default:index.html.twig', [
                'posts'   => $posts
            ]
        );
    }
}
