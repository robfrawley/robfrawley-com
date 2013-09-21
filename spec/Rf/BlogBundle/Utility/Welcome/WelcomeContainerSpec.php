<?php

namespace spec\Rf\BlogBundle\Utility\Welcome;

use PhpSpec\ObjectBehavior,
	Prophecy\Argument;
use Symfony\Component\DependencyInjection\ContainerInterface,
    Symfony\Bundle\FrameworkBundle\Templating\EngineInterface,
    Symfony\Component\HttpFoundation\Request,
    Symfony\Component\HttpFoundation\Response;
use Doctrine\Common\Persistence\ManagerRegistry,
    Doctrine\Common\Persistence\ObjectManager,
    Doctrine\Common\Persistence\ObjectRepository,
    Doctrine\ORM\EntityManager;
use Rf\BlogBundle\Entity\WelcomeRepository,
	Rf\BlogBundle\Entity\Welcome;

class WelcomeContainerSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('Rf\BlogBundle\Utility\Welcome\WelcomeContainer');
    }

	function let(ContainerInterface $container, ObjectManager $manager, EntityManager $em, WelcomeRepository $repository, Welcome $entity, Request $request)
    {
    	$em
    		->getRepository('RfBlogBundle:Welcome')
    		->willReturn($repository)
    	;
        $container
            ->has('doctrine.orm.entity_manager')
            ->willReturn(true)
        ;
        $container
            ->get('doctrine.orm.entity_manager')
            ->willReturn($em)
        ;
        $request
        	->get('_route')
        	->willReturn(null)
        ;
        $container
            ->has('request')
            ->willReturn(true)
        ;
        $container
            ->get('request')
            ->willReturn($request)
        ;
        $entity
        	->getHeader()
        	->willReturn('Header')
        ;
        $entity
        	->getBody()
        	->willReturn('Body')
        ;
        $repository
            ->findOneForContext(null)
            ->willReturn($entity)
        ;
        $manager
            ->getRepository('RfBlogBundle:Welcome')
            ->willReturn($repository)
        ;

        $this->setContainer($container);
    }

    function it_should_be_initialized()
    {
        $response = $this->initContext();
        $response->shouldHaveType(
            $this
        );
    }

    function it_should_have_a_header()
    {
    	$this
    		->getHeader()
    		->shouldReturn('Header')
    	;
    }

    function it_should_have_a_body()
    {
    	$this
    		->getBody()
    		->shouldReturn('Body')
    	;
    }
}