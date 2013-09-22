<?php
/*
 * This file is part of the Rob Frawley application
 *
 * (c) Rob Frawley 2nd <rmf@robfrawley.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Rf\BlogBundle\Entity;

use Doctrine\ORM\EntityRepository;

/**
 * PostRepository
 */
class PostRepository extends EntityRepository
{
    public function findLatest($limit=2)
    {   /*
        $q = $this
            ->createQueryBuilder('p')
            ->orderBy('p.posted', 'DESC')
            ->setMaxResults($limit)
            ->getQuery()
        ;
        */
        try {
            $entries = $q->getResult();
        }
        catch (NoResultException $e) {
            return null;
        }

        return $entries;
    }
}