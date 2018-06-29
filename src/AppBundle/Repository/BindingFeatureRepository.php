<?php

namespace AppBundle\Repository;

use Doctrine\ORM\EntityRepository;

class BindingFeatureRepository extends EntityRepository {

    /**
     * Prepare a type-ahead query and execute it.
     *
     * @param string $q
     * @return Collection|BindingFeature[]
     */
    public function typeaheadQuery($q) {
        $qb = $this->createQueryBuilder('e');
        $qb->andWhere("e.bindingFeature LIKE :q");
        $qb->orderBy('e.bindingFeature');
        $qb->setParameter('q', "{$q}%");
        return $qb->getQuery()->execute();
    }

}
