<?php

declare(strict_types=1);

/*
 * (c) 2020 Michael Joyce <mjoyce@sfu.ca>
 * This source file is subject to the GPL v2, bundled
 * with this source code in the file LICENSE.
 */

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * SupplementalPlaceData.
 *
 * @ORM\Table(name="supplemental_place_data")
 * @ORM\Entity(repositoryClass="App\Repository\SupplementalPlaceDataRepository")
 */
class SupplementalPlaceData {
    /**
     * @var int
     *
     * @ORM\Id
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\GeneratedValue()
     */
    private $id;

    /**
     * @var int
     *
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

    /**
     * Return string representation of place data.
     *
     * Formatted as geoname: latitude, longitude
     */
    public function __toString() : string {
        return $this->geoname . ': ' . $this->latitude . ',' . $this->longitude;
    }

    /**
     * Get id.
     *
     * @return int
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Set geonameId.
     *
     * @param int $geonameId
     *
     * @return SupplementalPlaceData
     */
    public function setGeonameId($geonameId) {
        $this->geonameId = $geonameId;

        return $this;
    }

    /**
     * Get geonameId.
     *
     * @return int
     */
    public function getGeonameId() {
        return $this->geonameId;
    }

    /**
     * Set geoname.
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
     * Get geoname.
     *
     * @return string
     */
    public function getGeoname() {
        return $this->geoname;
    }

    /**
     * Set latitude.
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
     * Get latitude.
     *
     * @return float
     */
    public function getLatitude() {
        return $this->latitude;
    }

    /**
     * Set longitude.
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
     * Get longitude.
     *
     * @return float
     */
    public function getLongitude() {
        return $this->longitude;
    }
}
