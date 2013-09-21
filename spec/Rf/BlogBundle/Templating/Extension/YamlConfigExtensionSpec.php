<?php

namespace spec\Rf\BlogBundle\Templating\Extension;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class YamlConfigExtensionSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('Rf\BlogBundle\Templating\Extension\YamlConfigExtension');
    }

    function let($config)
    {
        $config->beADoubleOf('\Rf\BlogBundle\Utility\Config\YamlConfigContainer');
        $this->beConstructedWith($config);
    }
}
