<?php

namespace AppBundle\Repository;

use Doctrine\ORM\EntityRepository;

class DigitalCopyHolderRepository extends EntityRepository {

    /**
     * Prepare a type-ahead query and execute it.
     *
     * @param string $q
     * @return Collection|DigitalCopyHolder[]
     */
    public function typeaheadQuery($q) {
        $qb = $this->createQueryBuilder('e');
        $qb->andWhere("e.organizationName LIKE :q");
        $qb->orderBy('e.organizationName');
        $qb->setParameter('q', "{$q}%");
        return $qb->getQuery()->execute();
    }

}
