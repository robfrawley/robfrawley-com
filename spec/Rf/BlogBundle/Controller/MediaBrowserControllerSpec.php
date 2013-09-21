<?php

namespace spec\Rf\BlogBundle\Controller;

use PhpSpec\ObjectBehavior,
	Prophecy\Argument;
use Symfony\Component\DependencyInjection\ContainerInterface,
	Symfony\Bundle\FrameworkBundle\Templating\EngineInterface,
	Symfony\Component\HttpFoundation\Response;

class MediaBrowserControllerSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('Rf\BlogBundle\Controller\MediaBrowserController');
    }

    function let(
		ContainerInterface $container,
        EngineInterface $templating
    ) {
        $container
        	->get('templating')
        	->willReturn($templating)
        ;
        $this->setContainer($container);
    }

    function it_should_respond_to_na_action(
    	EngineInterface $templating,
        Response $mockResponse
    ) {
        //$obj = $this->getWrappedObject();
        //$obj->getRoot()->willReturn('dir/path');
        //$obj->scanDir()->willReturn(['file1', 'file2']);

		$templating
            ->renderResponse(
                'RfBlogBundle:MediaBrowser:na.html.twig',
                array(
                	'dirs' => array('dir1', 'dir2'),
                	'files' => array('file1', 'file2'),
                	'path' => 'dir/path',
                	'bread' => array('bread1', 'bread2')
                ),
                null
            )
            ->willReturn($mockResponse)
        ;

    	$response = $this->naAction('dir/path');

    	$response->shouldHaveType(
    		'Symfony\Component\HttpFoundation\Response'
    	);
    }
}
