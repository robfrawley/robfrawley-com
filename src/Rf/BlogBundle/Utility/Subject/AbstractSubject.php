<?php
/*
 * This file is part of the Rob Frawley application
 *
 * (c) Rob Frawley 2nd <rmf@robfrawley.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Rf\BlogBundle\Utility\Subject;

use SplObserver,
    SplSubject;

/**
 * AbstractSubject
 */
class AbstractSubject implements SplSubject
{
    /**
     * @var array
     */
    protected $observers = [];

    /**
     * @param $observers array
     */
    public function __construct(array $observers = [])
    {
        foreach ($observers as $observer) {
            if ($observer instanceof SplObserver) {
                $this->attach($observer);
            }
        }
    }

    /**
     * @return $this|void
     */
    public function notify()
    {
        foreach ($this->observers as $observer) {
            $observer->update($this);
        }

        return $this;
    }

    /**
     * @param SplObserver $observer
     * @return $this|void
     */
    public function attach(SplObserver $observer, $allowDuplicate = false)
    {
        if ($allowDuplicate === true || !$this->has($observer)) {
            $this->observers[] = $observer;
        }

        return $this;
    }

    /**
     * @param SplObserver $observer
     * @return $this|void
     */
    public function detach(SplObserver $observer)
    {
        for ($i = 0; $i < count($this->observers); $i++) {
            if ($this->observers[$i] === $observer) {
                unset($this->observers[$i]);
            }
        }
        $this->observers = array_values($this->observers);

        return $this;
    }

    /**
     * @param SplObserver $observer
     * @return bool
     */
    public function has(SplObserver $observer)
    {
        foreach ($this->observers as $o) {
            if ($observer === $o) {
                return true;
            }
        }

        return false;
    }
}