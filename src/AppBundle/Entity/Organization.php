<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Organization
 *
 * @ORM\Table(name="organization", uniqueConstraints={@ORM\UniqueConstraint(name="organization_id_UNIQUE", columns={"organization_id"})}, indexes={@ORM\Index(name="fk_organization_uri_idx", columns={"organization_uri"}), @ORM\Index(name="fk_organization_entity1_idx", columns={"organization_entity_id"})})
 * @ORM\Entity
 */
class Organization
{

    /**
     * @var integer
     *
     * @ORM\Id
     * @ORM\Column(name="organization_id", type="integer", nullable=false)
     * @ORM\GeneratedValue()
     */
    private $organizationId;
    
    /**
     * @var integer
     *
     * @ORM\Column(name="organization_entity_id", type="integer", nullable=false, options={"default": 0})
     */
    private $organizationEntityId = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="organization_name", type="string", length=255, nullable=true)
     */
    private $organizationName;

    /**
     * @var string
     *
     * @ORM\Column(name="organization_uri", type="string", length=255, nullable=true)
     */
    private $organizationUri;

    /**
     * @var string
     *
     * @ORM\Column(name="organization_notes", type="text", length=16777215, nullable=true)
     */
    private $organizationNotes;


}

