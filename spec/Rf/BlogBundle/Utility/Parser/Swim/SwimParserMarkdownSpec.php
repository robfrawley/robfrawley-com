<?php

namespace spec\Rf\BlogBundle\Utility\Parser\Swim;

use PhpSpec\ObjectBehavior,
    Prophecy\Argument;
use Symfony\Component\DependencyInjection\ContainerInterface;

class SwimParserMarkdownSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('Rf\BlogBundle\Utility\Parser\Swim\SwimParserMarkdown');
    }

    function let(ContainerInterface $container)
    {
        $this->beConstructedWith($container);
    }
}
