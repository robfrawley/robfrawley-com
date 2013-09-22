<?php

namespace spec\Rf\BlogBundle\Controller;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Symfony\Component\DependencyInjection\ContainerInterface,
    Symfony\Bundle\FrameworkBundle\Templating\EngineInterface,
    Symfony\Component\HttpFoundation\Response,
    Symfony\Component\HttpFoundation\Request,
    Symfony\Component\HttpFoundation\Session\Session;
use Doctrine\Common\Persistence\ManagerRegistry,
    Doctrine\Common\Persistence\ObjectManager,
    Doctrine\Common\Persistence\ObjectRepository;
use Rf\BlogBundle\Entity\PostRepository;

class DefaultControllerSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('Rf\BlogBundle\Controller\DefaultController');
    }

    function let(ContainerInterface $container, Request $request, Session $session, ManagerRegistry $registry, ObjectManager $manager, PostRepository $repository, EngineInterface $templating)
    {
        $request
            ->getSession()
            ->willReturn($session)
        ;

        $container
            ->has('request')
            ->willReturn(true)
        ;
        $container
            ->get('request')
            ->willReturn($request)
        ;

        $container
            ->has('templating')
            ->willReturn(true)
        ;
        $container
            ->get('templating')
            ->willReturn($templating)
        ;

        $container
            ->has('templating')
            ->willReturn(true)
        ;
        $container
            ->get('templating')
            ->willReturn($templating)
        ;

        $container
            ->has('doctrine')
            ->willReturn(true)
        ;
        $container
            ->get('doctrine')
            ->willReturn($registry)
        ;

        $registry
            ->getManager()
            ->willReturn($manager)
        ;
        $manager
            ->getRepository('RfBlogBundle:Post')
            ->willReturn($repository)
        ;

        $this->setContainer($container);
    }

    function it_should_respond_to_index_action(PostRepository $repository, EngineInterface $templating, Response $mockResponse)
    {
        $repository
            ->findLatest(3)
            ->willReturn(array())
        ;
        $templating
            ->renderResponse(
                'RfBlogBundle:Default:index.html.twig',
                ['posts' => []],
                null
            )
            ->willReturn($mockResponse)
        ;

        $response = $this->indexAction();
        $response->shouldHaveType(
            'Symfony\Component\HttpFoundation\Response'
        );
    }

    function it_can_get_request_service(Request $request)
    {
        $this
            ->getServices(['request'])
            ->shouldReturn([$request])
        ;
    }

    function it_can_get_session_service(Session $session)
    {
        $this
            ->getServices(['session'])
            ->shouldReturn([$session])
        ;
    }

    function it_can_get_templating_service_from_container(EngineInterface $templating)
    {
        $this
            ->getServices(['templating'])
            ->shouldReturn([$templating])
        ;
    }
}
