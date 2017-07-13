<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * MapType
 *
 * @ORM\Table(name="map_type")
 * @ORM\Entity
 */
class MapType
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
     * @ORM\Column(name="map_type", type="string", length=255, nullable=true)
     */
    private $mapType;

    /**
     * @var string
     *
     * @ORM\Column(name="map_type_notes", type="text", length=16777215, nullable=true)
     */
    private $mapTypeNotes;

    
    public function __toString() {
        return $this->mapType;
    }


    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set mapType
     *
     * @param string $mapType
     *
     * @return MapType
     */
    public function setMapType($mapType)
    {
        $this->mapType = $mapType;

        return $this;
    }

    /**
     * Get mapType
     *
     * @return string
     */
    public function getMapType()
    {
        return $this->mapType;
    }

    /**
     * Set mapTypeNotes
     *
     * @param string $mapTypeNotes
     *
     * @return MapType
     */
    public function setMapTypeNotes($mapTypeNotes)
    {
        $this->mapTypeNotes = $mapTypeNotes;

        return $this;
    }

    /**
     * Get mapTypeNotes
     *
     * @return string
     */
    public function getMapTypeNotes()
    {
        return $this->mapTypeNotes;
    }
}
