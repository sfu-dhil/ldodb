<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * SupplementalPlaceData
 *
 * @ORM\Table(name="supplemental_place_data")
 * @ORM\Entity
 */
class SupplementalPlaceData
{
    /**
     * @var integer
     *
     * @ORM\Id
     * @ORM\Column(name="geonameid", type="integer", nullable=false)
     */
    private $geonameId;

    /**
     * @var string
     *
     * @ORM\Column(name="geoname", type="string", length=200, nullable=true)
     */
    private $geoname;

    /**
     * @var float
     *
     * @ORM\Column(name="latitude", type="float", precision=10, scale=5, nullable=true)
     */
    private $latitude;

    /**
     * @var float
     *
     * @ORM\Column(name="longitude", type="float", precision=10, scale=5, nullable=true)
     */
    private $longitude;


}

