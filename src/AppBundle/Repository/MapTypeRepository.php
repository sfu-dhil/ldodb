<?php

namespace AppBundle\Repository;

use Doctrine\ORM\EntityRepository;

class MapTypeRepository extends EntityRepository {

    /**
     * Prepare a type-ahead query and execute it.
     *
     * @param string $q
     * @return Collection|MapType[]
     */
    public function typeaheadQuery($q) {
        $qb = $this->createQueryBuilder('e');
        $qb->andWhere("e.mapType LIKE :q");
        $qb->orderBy('e.mapType');
        $qb->setParameter('q', "{$q}%");
        return $qb->getQuery()->execute();
    }

}
