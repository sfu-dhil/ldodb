<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * PlateType
 *
 * @ORM\Table(name="plate_type")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\PlateTypeRepository")
 */
class PlateType
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
     * @ORM\Column(name="plate_type", type="string", length=255, nullable=true)
     */
    private $plateType;

    /**
     * @var string
     *
     * @ORM\Column(name="plate_type_notes", type="text", length=16777215, nullable=true)
     */
    private $plateTypeNotes;


    public function __toString() {
        return $this->plateType;
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
     * Set plateType
     *
     * @param string $plateType
     *
     * @return PlateType
     */
    public function setPlateType($plateType) {
        $this->plateType = $plateType;

        return $this;
    }

    /**
     * Get plateType
     *
     * @return string
     */
    public function getPlateType() {
        return $this->plateType;
    }

    /**
     * Set plateTypeNotes
     *
     * @param string $plateTypeNotes
     *
     * @return PlateType
     */
    public function setPlateTypeNotes($plateTypeNotes) {
        $this->plateTypeNotes = $plateTypeNotes;

        return $this;
    }

    /**
     * Get plateTypeNotes
     *
     * @return string
     */
    public function getPlateTypeNotes() {
        return $this->plateTypeNotes;
    }
}
