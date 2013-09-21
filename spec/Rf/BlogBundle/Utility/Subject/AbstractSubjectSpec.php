<?php
/*
 * This file is part of the Rob Frawley application
 *
 * (c) Rob Frawley 2nd <rmf@robfrawley.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace spec\Rf\BlogBundle\Utility\Subject;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

/**
 * AbstractSubjectSpec
 */
class AbstractSubjectSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('Rf\BlogBundle\Utility\Subject\AbstractSubject');
    }

	function let($observer)
    {
        $observer->beADoubleOf('\Rf\BlogBundle\Utility\Observer\AbstractObserver');
        $this->beConstructedWith([$observer]);
    }

    /**
     * @param \Rf\BlogBundle\Utility\Observer\AbstractObserver $observer
     */
    function it_should_have_observer_count_of_zero($observer)
    {
    	$this
    		->detach($observer)
    		->shouldReturn($observer)
    	;
    	$this
    		->count()
    		->shouldReturn(0)
    	;
    }

    /**
     * @param \Rf\BlogBundle\Utility\Observer\AbstractObserver $observer
     */
    function it_lets_an_observer_detach($observer)
    {
    	$this
    		->detach($observer)
    		->shouldReturn($observer)
    	;
    }
    
    /**
     * @param \Rf\BlogBundle\Utility\Observer\AbstractObserver $observer
     */
    function it_lets_duplicate_observer_attach($observer)
    {
    	$this
    		->attach($observer, true)
    		->shouldReturn($observer)
    	;
    }

    /**
     * @param \Rf\BlogBundle\Utility\Observer\AbstractObserver $observer
     */
    function it_does_not_let_duplicate_observer_attach($observer)
    {
    	$this
    		->shouldThrow('\Exception')
    		->duringAttach($observer)
    	;
    }

	/**
     * @param \Rf\BlogBundle\Utility\Observer\AbstractObserver $observer
     * @param \Rf\BlogBundle\Utility\Observer\AbstractObserver $observer2
     */
    function it_has_an_observer($observer, $observer2)
    {
    	$this
    		->has($observer)
    		->shouldReturn(true)
    	;
    }

    /**
     * @param \Rf\BlogBundle\Utility\Observer\AbstractObserver $observer
     * @param \Rf\BlogBundle\Utility\Observer\AbstractObserver $observer2
     */
    function it_does_not_have_an_observer($observer, $observer2)
    {
    	$this
    		->has($observer2)
    		->shouldReturn(false)
    	;
    }

    function it_notifies_subjects()
    {
    	$this
    		->notify()
    		->shouldBeInteger()
    	;
    }
}
