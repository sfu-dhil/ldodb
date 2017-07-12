<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * PlacesOfTravel
 *
 * @ORM\Table(name="places_of_travel", indexes={@ORM\Index(name="fk_places_of_travel_place_idx", columns={"place_id"})})
 * @ORM\Entity
 */
class PlacesOfTravel
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

