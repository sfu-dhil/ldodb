<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ResidencePlace
 *
 * @ORM\Table(name="residence_place", indexes={@ORM\Index(name="fk_residence_place_place_idx", columns={"place_id"})})
 * @ORM\Entity
 */
class ResidencePlace
{
    /**
     * @var integer
     *
     * @ORM\Column(name="people_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $peopleId;

    /**
     * @var integer
     *
     * @ORM\Column(name="place_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $placeId;


}

