<?php
/*
 * This file is part of the Rob Frawley application
 *
 * (c) Rob Frawley 2nd <rmf@robfrawley.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Rf\BlogBundle\Utility\Parser\Swim;

use Symfony\Component\DependencyInjection\ContainerAwareInterface,
    Symfony\Component\DependencyInjection\ContainerInterface;
use Rf\BlogBundle\Utility\Container\ContainerAwareTrait,
    Rf\BlogBundle\Utility\Observer\AbstractObserver,
    Rf\BlogBundle\Utility\Filters\String;
use SplSubject;

/**
 * SwimObserver
 */
class SwimObserver extends AbstractObserver implements ContainerAwareInterface
{
    use ContainerAwareTrait;

    /**
     * @param SplSubject $subject
     * @return $this
     */
    public function update(SplSubject $subject)
    {
        $content = $subject->getContent();
        $content = $this->render($content);
        $subject->setContent($content);

        return $this;
    }
}