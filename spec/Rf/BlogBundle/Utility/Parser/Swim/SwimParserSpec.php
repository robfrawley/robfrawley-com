<?php

namespace spec\Rf\BlogBundle\Utility\Parser\Swim;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Kwattro\MarkdownBundle\Markdown\KwattroMarkdown,
    Symfony\Component\DependencyInjection\ContainerInterface,
    Symfony\Component\Routing\Router;

class SwimParserSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('Rf\BlogBundle\Utility\Parser\Swim\SwimParser');
    }

    function let(ContainerInterface $container, KwattroMarkdown $markdown, Router $router)
    {
        $container
            ->has('kwattro_markdown')
            ->willReturn(true)
        ;
        $container
            ->get('kwattro_markdown')
            ->willReturn($markdown)
        ;
        $container
            ->has('router')
            ->willReturn(true)
        ;
        $container
            ->get('router')
            ->willReturn($router)
        ;

        $this->beConstructedWith($container);
    }

    function it_can_set_config()
    {
    	$this
    		->configure(['ExternalLink'])
    		->shouldReturn($this)
    	;
    }

    function it_can_ignore_lack_of_config()
    {
    	$this
    		->configure()
    		->shouldReturn($this)
    	;
    }

    function it_can_setup_new_runtime_from_configure()
    {
        $this
            ->configure(['ExternalLink'], true)
            ->shouldReturn($this)
        ;
        $this
            ->configure(['ExternalLink'], false)
            ->shouldReturn($this)
        ;
        $this
            ->configure(['InternalLink'], false)
            ->shouldReturn($this)
        ;
    }

    function it_can_set_and_get_content()
    {
    	$this
    		->setContent('content')
    		->shouldReturn($this)
    	;
    	$this
    		->getContent()
    		->shouldReturn('content')
    	;
    }

    function it_can_parse_content()
    {
    	$this
    		->setContent()
    		->shouldReturn($this)
    	;
    	$this
    		->render()
    		->shouldReturn(null)
    	;
    }
}
