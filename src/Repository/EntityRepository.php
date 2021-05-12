<?php

declare(strict_types=1);

/*
 * (c) 2021 Michael Joyce <mjoyce@sfu.ca>
 * This source file is subject to the GPL v2, bundled
 * with this source code in the file LICENSE.
 */

namespace App\Repository;

use App\Entity\Entity;
use App\Entity\Organization;
use App\Entity\People;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository as BaseRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\Persistence\ManagerRegistry;

class EntityRepository extends BaseRepository {
    public function __construct(ManagerRegistry $registry) {
        parent::__construct($registry, Entity::class);
    }

    /**
     * Prepare a type-ahead query and execute it.
     *
     * @param string $q
     *
     * @return Collection|Entity[]
     */
    public function typeaheadQuery($q) {
        $peopleRepo = $this->_em->getRepository(People::class);
        $organizationRepo = $this->_em->getRepository(Organization::class);

        return new ArrayCollection(
            array_merge(
                $peopleRepo->typeaheadQuery($q),
                $organizationRepo->typeaheadQuery($q)
            )
        );
    }
}
