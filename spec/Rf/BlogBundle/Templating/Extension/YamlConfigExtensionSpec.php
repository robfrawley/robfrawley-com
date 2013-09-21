<?php

namespace spec\Rf\BlogBundle\Templating\Extension;

use PhpSpec\ObjectBehavior,
    Prophecy\Argument;
use Rf\BlogBundle\Utility\Config\YamlConfigContainer;

class YamlConfigExtensionSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('Rf\BlogBundle\Templating\Extension\YamlConfigExtension');
    }

    function let(YamlConfigContainer $config)
    {   
        $this->beConstructedWith($config);
    }

    function it_can_get_config()
    {
    	$this
    		->getConfig('key')
    		->shouldReturn(null)
    	;
    }

    function it_can_return_function_array()
    {
    	$this
    		->getFunctions()
    		->shouldBeArray()
    	;
    }
}
