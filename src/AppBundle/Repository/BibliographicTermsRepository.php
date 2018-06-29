<?php

namespace AppBundle\Repository;

use AppBundle\Entity\BibliographicTerms;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\EntityRepository;

class BibliographicTermsRepository extends EntityRepository {

    /**
     * Prepare a type-ahead query and execute it.
     *
     * @param string $q
     * @return Collection|BibliographicTerms[]
     */
    public function typeaheadQuery($q) {
        $qb = $this->createQueryBuilder('e');
        $qb->andWhere("e.bibliographicTerm LIKE :q");
        $qb->orderBy('e.bibliographicTerm');
        $qb->setParameter('q', "{$q}%");
        return $qb->getQuery()->execute();
    }
}
