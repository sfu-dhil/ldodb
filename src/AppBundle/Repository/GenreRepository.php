<?php

namespace AppBundle\Repository;

use Doctrine\ORM\EntityRepository;

class GenreRepository extends EntityRepository {

    /**
     * Prepare a type-ahead query and execute it.
     *
     * @param string $q
     * @return Collection|Genre[]
     */
    public function typeaheadQuery($q) {
        $qb = $this->createQueryBuilder('e');
        $qb->andWhere("e.genreName LIKE :q");
        $qb->orderBy('e.genreName');
        $qb->setParameter('q', "{$q}%");
        return $qb->getQuery()->execute();
    }

}
