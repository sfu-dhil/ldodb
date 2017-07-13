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


    public function __toString() {
        return $this->geoname . ": " . $this->latitude . ',' . $this->longitude;
    }


    /**
     * Set geonameId
     *
     * @param integer $geonameId
     *
     * @return SupplementalPlaceData
     */
    public function setGeonameId($geonameId) {
        $this->geonameId = $geonameId;

        return $this;
    }

    /**
     * Get geonameId
     *
     * @return integer
     */
    public function getGeonameId() {
        return $this->geonameId;
    }

    /**
     * Set geoname
     *
     * @param string $geoname
     *
     * @return SupplementalPlaceData
     */
    public function setGeoname($geoname) {
        $this->geoname = $geoname;

        return $this;
    }

    /**
     * Get geoname
     *
     * @return string
     */
    public function getGeoname() {
        return $this->geoname;
    }

    /**
     * Set latitude
     *
     * @param float $latitude
     *
     * @return SupplementalPlaceData
     */
    public function setLatitude($latitude) {
        $this->latitude = $latitude;

        return $this;
    }

    /**
     * Get latitude
     *
     * @return float
     */
    public function getLatitude() {
        return $this->latitude;
    }

    /**
     * Set longitude
     *
     * @param float $longitude
     *
     * @return SupplementalPlaceData
     */
    public function setLongitude($longitude) {
        $this->longitude = $longitude;

        return $this;
    }

    /**
     * Get longitude
     *
     * @return float
     */
    public function getLongitude() {
        return $this->longitude;
    }
}
