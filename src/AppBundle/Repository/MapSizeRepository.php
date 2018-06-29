<?php

namespace AppBundle\Repository;

use Doctrine\ORM\EntityRepository;

class MapSizeRepository extends EntityRepository {

    /**
     * Prepare a type-ahead query and execute it.
     *
     * @param string $q
     * @return Collection|MapSize[]
     */
    public function typeaheadQuery($q) {
        $qb = $this->createQueryBuilder('e');
        $qb->andWhere("e.mapSize LIKE :q");
        $qb->orderBy('e.mapSize');
        $qb->setParameter('q', "{$q}%");
        return $qb->getQuery()->execute();
    }

}
