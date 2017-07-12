<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Entity
 *
 * @ORM\Table(name="entity", uniqueConstraints={@ORM\UniqueConstraint(name="people_id_UNIQUE", columns={"people_id"}), @ORM\UniqueConstraint(name="organization_id_UNIQUE", columns={"organization_id"})})
 * @ORM\Entity
 */
class Entity
{
    /**
     * @var integer
     *
     * @ORM\Id
     * @ORM\Column(name="entity_id", type="integer", nullable=false)
     * @ORM\GeneratedValue()
     */
    private $entityId;

    /**
     * @var string
     *
     * @ORM\Column(name="entity_type", type="string", length=3, nullable=false, options={"fixed": true})
     */
    private $entityType;

    /**
     * @var integer
     *
     * @ORM\Column(name="people_id", type="integer", nullable=true)
     */
    private $peopleId;

    /**
     * @var integer
     *
     * @ORM\Column(name="organization_id", type="integer", nullable=true)
     */
    private $organizationId;


}

