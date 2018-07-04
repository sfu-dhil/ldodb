<?php

namespace AppBundle\Repository;

use Doctrine\ORM\EntityRepository;

class OrganizationRepository extends EntityRepository {

    /**
     * Prepare a type-ahead query and execute it.
     *
     * @param string $q
     * @return Collection|Organization[]
     */
    public function typeaheadQuery($q) {
        $qb = $this->createQueryBuilder('e');
        $qb->andWhere("e.organizationName LIKE :q");
        $qb->orderBy('e.organizationName');
        $qb->setParameter('q', "{$q}%");
        return $qb->getQuery()->execute();
    }

    /**
     * Prepare a search query, but do not execute it.
     *
     * @param string $q
     * @return Collection|Organization[]
     */
    public function searchQuery($q) {
        $qb = $this->createQueryBuilder('e');
        $qb->addSelect("MATCH (e.organizationName) AGAINST(:q BOOLEAN) as HIDDEN score");
        $qb->addSelect("MATCH (e.organizationName) AGAINST(:q BOOLEAN) > 0.5");
        $qb->orderBy('score', 'DESC');
        $qb->setParameter('q', $q);
        return $qb->getQuery();
    }

}
