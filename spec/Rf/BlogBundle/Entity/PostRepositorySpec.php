<?php

namespace spec\Rf\BlogBundle\Entity;

use PhpSpec\ObjectBehavior,
    Prophecy\Argument;
use Doctrine\ORM\EntityManager,
    Doctrine\ORM\Mapping\ClassMetadata,
    Doctrine\ORM\QueryBuilder;

class PostRepositorySpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('Rf\BlogBundle\Entity\PostRepository');
    }

    function let(EntityManager $em, ClassMetadata $class)
    {
        $this->beConstructedWith($em, $class);
    }
}