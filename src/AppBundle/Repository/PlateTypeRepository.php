<?php

namespace AppBundle\Repository;

use Doctrine\ORM\EntityRepository;

class PlateTypeRepository extends EntityRepository {

    /**
     * Prepare a type-ahead query and execute it.
     *
     * @param string $q
     * @return Collection|PlateType[]
     */
    public function typeaheadQuery($q) {
        $qb = $this->createQueryBuilder('e');
        $qb->andWhere("e.plateType LIKE :q");
        $qb->orderBy('e.plateType');
        $qb->setParameter('q', "{$q}%");
        return $qb->getQuery()->execute();
    }

}
