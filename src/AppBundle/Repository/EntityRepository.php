<?php

namespace AppBundle\Repository;

use AppBundle\Entity\Entity;
use AppBundle\Entity\Organization;
use AppBundle\Entity\People;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\EntityRepository as BaseRepository;

class EntityRepository extends BaseRepository {

    /**
     * Prepare a type-ahead query and execute it.
     *
     * @param string $q
     * @return Collection|Entity[]
     */
    public function typeaheadQuery($q) {
        $peopleRepo = $this->_em->getRepository(People::class);
        $organizationRepo = $this->_em->getRepository(Organization::class);

        $collection = new ArrayCollection(
            array_merge(
                $peopleRepo->typeaheadQuery($q),
                $organizationRepo->typeaheadQuery($q)
            )
        );

        return $collection;
    }

}
