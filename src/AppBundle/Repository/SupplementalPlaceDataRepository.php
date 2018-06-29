<?php

namespace AppBundle\Repository;

use Doctrine\ORM\EntityRepository;

class SupplementalPlaceDataRepository extends EntityRepository {

    /**
     * Prepare a type-ahead query and execute it.
     *
     * @param string $q
     * @return Collection|SupplimentalPlaceData[]
     */
    public function typeaheadQuery($q) {
        $qb = $this->createQueryBuilder('e');
        $qb->andWhere("e.geoname LIKE :q");
        $qb->orderBy('e.geoname');
        $qb->setParameter('q', "{$q}%");
        return $qb->getQuery()->execute();
    }

}
