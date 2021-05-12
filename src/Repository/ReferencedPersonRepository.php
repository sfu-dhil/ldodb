<?php

declare(strict_types=1);

/*
 * (c) 2021 Michael Joyce <mjoyce@sfu.ca>
 * This source file is subject to the GPL v2, bundled
 * with this source code in the file LICENSE.
 */

namespace App\Repository;

use App\Entity\ReferencedPerson;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class ReferencedPersonRepository extends ServiceEntityRepository {
    public function __construct(ManagerRegistry $registry) {
        parent::__construct($registry, ReferencedPerson::class);
    }

    /**
     * Prepare a type-ahead query and execute it.
     *
     * @param string $q
     *
     * @return Collection|ReferencedPerson[]
     */
    public function typeaheadQuery($q) {
        $qb = $this->createQueryBuilder('e');
        $qb->andWhere("CONCAT_WS(' ', e.lastName, e.firstName) LIKE :q");
        $qb->orderBy('e.lastName');
        $qb->orderBy('e.firstName');
        $qb->setParameter('q', "{$q}%");

        return $qb->getQuery()->execute();
    }

    /**
     * Prepare a search query, but do not execute it.
     *
     * @param string $q
     *
     * @return Collection|ReferencedPerson[]
     */
    public function searchQuery($q) {
        $qb = $this->createQueryBuilder('e');
        $qb->addSelect('MATCH (e.firstName, e.lastName) AGAINST(:q BOOLEAN) as HIDDEN score');
        $qb->addSelect('MATCH (e.firstName, e.lastName) AGAINST(:q BOOLEAN) > 0.0');
        $qb->orderBy('score', 'DESC');
        $qb->setParameter('q', $q);

        return $qb->getQuery();
    }
}
