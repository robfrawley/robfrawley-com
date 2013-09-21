<?php

namespace spec\Rf\BlogBundle;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Symfony\Component\DependencyInjection\ContainerInterface;

class RfBlogBundleSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('Rf\BlogBundle\RfBlogBundle');
    }

	function let(ContainerInterface $container)
    {
        $this->setContainer($container);
    }
}
