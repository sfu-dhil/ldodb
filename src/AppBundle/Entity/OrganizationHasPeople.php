<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * OrganizationHasPeople
 *
 * @ORM\Table(name="organization_has_people", indexes={@ORM\Index(name="fk_organization_has_people_people1_idx", columns={"people_id"})})
 * @ORM\Entity
 */
class OrganizationHasPeople
{
    /**
     * @var integer
     *
     * @ORM\Column(name="organization_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $organizationId;

    /**
     * @var integer
     *
     * @ORM\Column(name="people_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $peopleId;


}

