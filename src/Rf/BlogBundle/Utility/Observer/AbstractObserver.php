<?php
/*
 * This file is part of the Rob Frawley application
 *
 * (c) Rob Frawley 2nd <rmf@robfrawley.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Rf\BlogBundle\Utility\Observer;

use SplObserver,
    SplSubject;

/**
 * AbstractObserver
 */
abstract class AbstractObserver implements SplObserver
{
    abstract public function update(SplSubject $subject);
}