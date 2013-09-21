<?php

namespace spec\Rf\BlogBundle\Controller;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Symfony\Component\DependencyInjection\ContainerInterface,
    Symfony\Bundle\FrameworkBundle\Templating\EngineInterface,
    Symfony\Component\HttpFoundation\Response;
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

    function let(ContainerInterface $container, ManagerRegistry $registry, ObjectManager $manager, PostRepository $repository, EngineInterface $templating)
    {
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
        $container
            ->get('templating')
            ->willReturn($templating)
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
}
