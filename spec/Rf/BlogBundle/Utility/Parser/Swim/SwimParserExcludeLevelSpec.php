<?php

namespace spec\Rf\BlogBundle\Utility\Parser\Swim;

use PhpSpec\ObjectBehavior,
	Prophecy\Argument;
use Symfony\Component\DependencyInjection\ContainerInterface;

class SwimParserExcludeLevelSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('Rf\BlogBundle\Utility\Parser\Swim\SwimParserExcludeLevel');
    }

    function let(ContainerInterface $container)
    {
        $this->beConstructedWith($container);
    }

    function it_can_exclude_text_and_set_anchor_point()
    {
    	$this
    		->render('String with{~ex:start} some excluded{~ex:end} text')
    		->shouldReturn('String with{~ex:anchor:12c691a2d74ddfc9a137c541785f93a6} text')
    	;
    }

    function it_can_exclude_text_and_then_reinclude_text()
    {
    	$this
    		->render('String with{~ex:start} some excluded{~ex:end} text')
    		->shouldReturn('String with{~ex:anchor:12c691a2d74ddfc9a137c541785f93a6} text')
    	;
    	$this
    		->render('String with{~ex:anchor:12c691a2d74ddfc9a137c541785f93a6} text')
    		->shouldReturn('String with some excluded text')
    	;
    }
}