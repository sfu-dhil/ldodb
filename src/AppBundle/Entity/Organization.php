<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Organization
 *
 * @ORM\Table(name="organization")
 * @ORM\Entity
 */
class Organization extends Entity
{
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

    
    public function __toString() {
        return $this->organizationName;
    }

}

