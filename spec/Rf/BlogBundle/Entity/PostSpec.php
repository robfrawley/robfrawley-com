<?php

namespace spec\Rf\BlogBundle\Entity;

use PhpSpec\ObjectBehavior,
	Prophecy\Argument;
use Datetime;
use Rf\BlogBundle\Utility\Filters\String;

class PostSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('Rf\BlogBundle\Entity\Post');
    }

    function it_can_get_id()
    {
    	$this
    		->getId()
    		->shouldReturn(null)
    	;
    }

    function it_can_set_and_get_posted()
    {
    	$posted = new Datetime();

    	$this
    		->setPosted($posted)
    		->shouldReturn($this)
    	;

    	$this
    		->getPosted()
    		->shouldReturn($posted)
    	;

    	$this
    		->getPostedFormatted('r')
    		->shouldReturn($posted->format('r'))
    	;
    }

    function it_can_set_and_get_location()
    {
    	$location = 'A Location';

    	$this
    		->setLocation($location)
    		->shouldReturn($this)
    	;

    	$this
    		->getLocation()
    		->shouldReturn($location)
    	;
    }

    function it_can_set_and_get_title()
    {
    	$title = 'A Title';

    	$this
    		->setTitle($title)
    		->shouldReturn($this)
    	;

    	$this
    		->getTitle()
    		->shouldReturn($title)
    	;

    	$this
    		->getTitleKey()
    		->shouldReturn(String::toAlphanumericAndDashes($title))
    	;
    }

    function it_can_set_and_get_entry()
    {
    	$entry = 'An Entry';

    	$this
    		->setEntry($entry)
    		->shouldReturn($this)
    	;

    	$this
    		->getEntry()
    		->shouldReturn($entry)
    	;
    }
}
