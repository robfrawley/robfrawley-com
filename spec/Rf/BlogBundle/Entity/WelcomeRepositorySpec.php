<?php

namespace spec\Rf\BlogBundle\Entity;

use PhpSpec\ObjectBehavior,
    Prophecy\Argument;
use Doctrine\ORM\EntityManager,
    Doctrine\ORM\Mapping\ClassMetadata,
    Doctrine\ORM\QueryBuilder;

class WelcomeRepositorySpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('Rf\BlogBundle\Entity\WelcomeRepository');
    }

    function let(EntityManager $em, ClassMetadata $class)
    {
        $this->beConstructedWith($em, $class);
    }
}
