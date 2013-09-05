<?php
/*
 * This file is part of the Rob Frawley application
 *
 * (c) Rob Frawley 2nd <rmf@robfrawley.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Rf\BlogBundle\Features\Context;

use Symfony\Bundle\FrameworkBundle\Tests\Functional\AppKernel;
use Symfony\Component\HttpKernel\KernelInterface;
use Behat\Symfony2Extension\Context\KernelAwareInterface;
use Behat\MinkExtension\Context\MinkContext;

use Behat\Behat\Context\BehatContext,
    Behat\Behat\Exception\PendingException;
use Behat\Gherkin\Node\PyStringNode,
    Behat\Gherkin\Node\TableNode;

require_once 'PHPUnit/Autoload.php';
require_once 'PHPUnit/Framework/Assert/Functions.php';

/**
 * Class FeatureContext
 */
class FeatureContext
    extends    MinkContext
    implements KernelAwareInterface
{
    /**
     * @var KernelInterface
     */
    private $kernel;

    /**
     * @var array
     */
    private $parameters;

    /**
     * @param array $parameters
     */
    public function __construct(array $parameters)
    {
        $this->parameters = $parameters;
    }

    /**
     * @param KernelInterface $kernel
     */
    public function setKernel(KernelInterface $kernel)
    {
        $this->kernel = $kernel;
    }

    /**
     * @Then /^Container should have parameter "([^"]*)"$/
     */
    public function assertContainerHasParameter($config_key)
    {
        $container = $this->kernel->getContainer();
        $container->getParameter($config_key);
    }

    /**
     * @Given /^The app kernel is available$/
     */
    public function assertAppKernelIsAvailable()
    {
        if(! $this->kernel instanceof \AppKernel)
        {
            throw new \Exception('The App Kernel is not available');
        }
    }

    /**
     * @Given /^The container is available$/
     */
    public function assertContainerIsAvailable()
    {
        if(! $this->kernel->getContainer() instanceof \appTestDebugProjectContainer)
        {
            throw new \Exception('The App Debug Project Container is not available');
        }
    }
}