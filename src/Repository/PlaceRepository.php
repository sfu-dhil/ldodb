<?php

declare(strict_types=1);

/*
 * (c) 2021 Michael Joyce <mjoyce@sfu.ca>
 * This source file is subject to the GPL v2, bundled
 * with this source code in the file LICENSE.
 */

namespace App\Repository;

use App\Entity\Place;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\Query;
use Doctrine\Persistence\ManagerRegistry;

class PlaceRepository extends ServiceEntityRepository {
    public function __construct(ManagerRegistry $registry) {
        parent::__construct($registry, Place::class);
    }

    /**
     * Prepare a type-ahead query and execute it.
     *
     * @param string $q
     *
     * @return Collection|Place[]
     */
    public function typeaheadQuery($q) {
        $qb = $this->createQueryBuilder('e');
        $qb->andWhere('e.placeName LIKE :q');
        $qb->orderBy('e.placeName');
        $qb->setParameter('q', "{$q}%");

        return $qb->getQuery()->execute();
    }

    /**
     * Prepare a search query, but do not execute it.
     *
     * @param string $q
     *
     * @return Query
     */
    public function searchQuery($q) {
        $qb = $this->createQueryBuilder('e');
        $qb->andWhere('MATCH (e.placeName) AGAINST(:q BOOLEAN) > 0.0');
        $qb->setParameter('q', $q);

        return $qb->getQuery();
    }
}
