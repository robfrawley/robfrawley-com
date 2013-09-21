<?php

namespace spec\Rf\BlogBundle\Entity;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class PostRepositorySpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('Rf\BlogBundle\Entity\PostRepository');
    }

    function let($em, $class)
    {
        $em->beADoubleOf('\Doctrine\ORM\EntityManager');
        $class->beADoubleOf('\Doctrine\ORM\Mapping\ClassMetadata');
        $this->beConstructedWith($em, $class);
    }
}
