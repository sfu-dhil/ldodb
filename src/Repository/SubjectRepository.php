<?php

declare(strict_types=1);

/*
 * (c) 2020 Michael Joyce <mjoyce@sfu.ca>
 * This source file is subject to the GPL v2, bundled
 * with this source code in the file LICENSE.
 */

namespace App\Repository;

use App\Entity\Subject;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class SubjectRepository extends ServiceEntityRepository {
    public function __construct(ManagerRegistry $registry) {
        parent::__construct($registry, Subject::class);
    }

    /**
     * Prepare a type-ahead query and execute it.
     *
     * @param string $q
     *
     * @return Collection|Subject[]
     */
    public function typeaheadQuery($q) {
        $qb = $this->createQueryBuilder('e');
        $qb->andWhere('e.subjectName LIKE :q');
        $qb->orderBy('e.subjectName');
        $qb->setParameter('q', "{$q}%");

        return $qb->getQuery()->execute();
    }

    /**
     * Prepare a search query, but do not execute it.
     *
     * @param string $q
     *
     * @return Collection|Subject[]
     */
    public function searchQuery($q) {
        $qb = $this->createQueryBuilder('e');
        $qb->addSelect('MATCH (e.subjectName) AGAINST(:q BOOLEAN) as HIDDEN score');
        $qb->andWhere('MATCH (e.subjectName) AGAINST(:q BOOLEAN) > 0.0');
        $qb->orderBy('score', 'DESC');
        $qb->setParameter('q', $q);

        return $qb->getQuery();
    }
}
