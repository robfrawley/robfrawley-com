<?php

namespace spec\Rf\BlogBundle\Utility\Parser\Swim;

use PhpSpec\ObjectBehavior,
	Prophecy\Argument;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Kwattro\MarkdownBundle\Markdown\KwattroMarkdown;

class SwimParserQueriesSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('Rf\BlogBundle\Utility\Parser\Swim\SwimParserQueries');
    }

    function let(ContainerInterface $container, KwattroMarkdown $markdown)
    {
    	$container
            ->has('kwattro_markdown')
            ->willReturn(true)
        ;
        $container
            ->get('kwattro_markdown')
            ->willReturn($markdown)
        ;
        $this->beConstructedWith($container);
    }

    function it_can_parse_swim_queries_tip_markup()
    {
    	$this
    		->render('{~-:This is a tip query}')
    		->shouldReturn(
    			'<div class="callout callout-info"><p class="callout-header">Tip</p></div>'
    		)
    	;
    }

    function it_can_parse_swim_queries_note_markup()
    {
    	$this
    		->render('{~?:This is a note query}')
    		->shouldReturn(
    			'<div class="callout callout-warning"><p class="callout-header">Note</p></div>'
    		)
    	;
    }

    function it_can_parse_swim_queries_important_markup()
    {
    	$this
    		->render('{~!:This is an important query}')
    		->shouldReturn(
    			'<div class="callout callout-danger"><p class="callout-header">Key Point</p></div>'
    		)
    	;
    }
}
