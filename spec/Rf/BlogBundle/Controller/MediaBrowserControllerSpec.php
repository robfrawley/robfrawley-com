<?php

namespace spec\Rf\BlogBundle\Controller;

use PhpSpec\ObjectBehavior,
    Prophecy\Argument;
use Symfony\Component\DependencyInjection\ContainerInterface,
    Symfony\Bundle\FrameworkBundle\Templating\EngineInterface,
    Symfony\Component\HttpFoundation\Response,
    Symfony\Component\HttpFoundation\RedirectResponse;

class MediaBrowserControllerSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('Rf\BlogBundle\Controller\MediaBrowserController');
    }

    function let(ContainerInterface $container, EngineInterface $templating)
    {
        $container
            ->get('templating')
            ->willReturn($templating)
        ;
        $this->setContainer($container);
    }

    function it_should_respond_to_na_action(EngineInterface $templating, Response $mockResponse) 
    {
        $templating
            ->renderResponse(
                'RfBlogBundle:MediaBrowser:na.html.twig',
                array(
                    'dirs' => array(),
                    'files' => array(),
                    'path' => '',
                    'bread' => array()
                ),
                null
            )
            ->willReturn($mockResponse)
        ;

        $response = $this->naAction('');
        $response->shouldHaveType(
            'Symfony\Component\HttpFoundation\Response'
        );
    }

    function it_can_explore_a_root()
    {
        $this->setRoot(__DIR__.'/../');
        $this->exploreRoot();
    }

    function it_should_redirect_to_download()
    {
        $this
            ->naDownloadAction('a/path')
            ->shouldHaveType('Symfony\Component\HttpFoundation\RedirectResponse')
        ;
    }
}
