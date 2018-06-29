<?php

namespace AppBundle\Repository;

use Doctrine\ORM\EntityRepository;

class TaskRepository extends EntityRepository {

    /**
     * Prepare a type-ahead query and execute it.
     *
     * @param string $q
     * @return Collection|Task[]
     */
    public function typeaheadQuery($q) {
        $qb = $this->createQueryBuilder('e');
        $qb->andWhere("e.taskName LIKE :q");
        $qb->orderBy('e.taskName');
        $qb->setParameter('q', "{$q}%");
        return $qb->getQuery()->execute();
    }

}
