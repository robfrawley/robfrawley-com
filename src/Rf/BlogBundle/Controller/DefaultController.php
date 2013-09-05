<?php

namespace Rf\BlogBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('RfBlogBundle:Default:index.html.twig', array('name' => $name));
    }
}
