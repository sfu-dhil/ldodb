<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * MapSize
 *
 * @ORM\Table(name="map_size")
 * @ORM\Entity
 */
class MapSize
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
     * @ORM\Column(name="map_size", type="string", length=255, nullable=true)
     */
    private $mapSize;

    /**
     * @var string
     *
     * @ORM\Column(name="map_size_notes", type="text", length=16777215, nullable=true)
     */
    private $mapSizeNotes;

    
    public function __toString() {
        return $this->mapType;
    }

}

