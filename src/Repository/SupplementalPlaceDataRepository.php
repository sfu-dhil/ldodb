<?php

declare(strict_types=1);

/*
 * (c) 2021 Michael Joyce <mjoyce@sfu.ca>
 * This source file is subject to the GPL v2, bundled
 * with this source code in the file LICENSE.
 */

namespace App\Repository;

use App\Entity\SupplementalPlaceData;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class SupplementalPlaceDataRepository extends ServiceEntityRepository {
    public function __construct(ManagerRegistry $registry) {
        parent::__construct($registry, SupplementalPlaceData::class);
    }

    /**
     * Prepare a type-ahead query and execute it.
     *
     * @param string $q
     *
     * @return Collection|SupplimentalPlaceData[]
     */
    public function typeaheadQuery($q) {
        $qb = $this->createQueryBuilder('e');
        $qb->andWhere('e.geoname LIKE :q');
        $qb->orderBy('e.geoname');
        $qb->setParameter('q', "{$q}%");

        return $qb->getQuery()->execute();
    }
}
