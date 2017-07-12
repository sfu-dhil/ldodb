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
     * @ORM\Column(name="map_type_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $mapTypeId;

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


}

