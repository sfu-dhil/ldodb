<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * PlateType
 *
 * @ORM\Table(name="plate_type")
 * @ORM\Entity
 */
class PlateType
{
    /**
     * @var integer
     *
     * @ORM\Column(name="plate_type_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $plateTypeId;

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


}

