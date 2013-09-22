<?php

namespace spec\Rf\BlogBundle\Entity;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class WelcomeSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('Rf\BlogBundle\Entity\Welcome');
    }

    function it_can_get_id()
    {
    	$this
    		->getId()
    		->shouldReturn(null)
    	;
    }

    function it_can_set_and_get_header()
    {
    	$header = 'A Header';

    	$this
    		->setHeader($header)
    		->shouldReturn($this)
    	;

    	$this
    		->getHeader()
    		->shouldReturn($header)
    	;
    }

    function it_can_set_and_get_body()
    {
    	$body = 'A Body';

    	$this
    		->setBody($body)
    		->shouldReturn($this)
    	;

    	$this
    		->getBody()
    		->shouldReturn($body)
    	;
    }

    function it_can_set_and_get_urltext()
    {
    	$urlText = 'URL Text';

    	$this
    		->setUrlText($urlText)
    		->shouldReturn($this)
    	;

    	$this
    		->getUrlText()
    		->shouldReturn($urlText)
    	;
    }

    function it_can_set_and_get_urlhref()
    {
    	$urlHref = 'http://a-url.com/';

    	$this
    		->setUrlHref($urlHref)
    		->shouldReturn($this)
    	;

    	$this
    		->getUrlHref()
    		->shouldReturn($urlHref)
    	;
    }

    function it_can_set_and_get_matcher()
    {
    	$matcher = 'a-matcher';

    	$this
    		->setMatcher($matcher)
    		->shouldReturn($this)
    	;

    	$this
    		->getMatcher()
    		->shouldReturn($matcher)
    	;
    }
}
