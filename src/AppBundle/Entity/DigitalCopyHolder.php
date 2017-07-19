<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * DigitalCopyHolder
 *
 * @ORM\Table(name="digital_copy_holder")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\DigitalCopyHolderRepository")
 */
class DigitalCopyHolder
{
    /**
     * @var integer
     *
     * @ORM\Id
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\GeneratedValue()
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="organization_name", type="string", length=255, nullable=true)
     */
    private $organizationName;


    public function __toString() {
        return $this->organizationName;
    }


    /**
     * Get id
     *
     * @return integer
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Set organizationName
     *
     * @param string $organizationName
     *
     * @return DigitalCopyHolder
     */
    public function setOrganizationName($organizationName) {
        $this->organizationName = $organizationName;

        return $this;
    }

    /**
     * Get organizationName
     *
     * @return string
     */
    public function getOrganizationName() {
        return $this->organizationName;
    }
}
