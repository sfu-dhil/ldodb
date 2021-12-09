<?php

declare(strict_types=1);

/*
 * (c) 2021 Michael Joyce <mjoyce@sfu.ca>
 * This source file is subject to the GPL v2, bundled
 * with this source code in the file LICENSE.
 */

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Nines\UtilBundle\Entity\AbstractEntity;
use Symfony\Component\Validator\Constraints as Assert;
use Nines\SolrBundle\Annotation as Solr;

/**
 * Place.
 *
 * @ORM\Table(name="place", indexes={
 *     @ORM\Index(columns={"place_name"}, flags={"fulltext"}),
 * })
 * @ORM\Entity(repositoryClass="App\Repository\PlaceRepository")
 *
 * @Solr\Document(
 *     copyField=@Solr\CopyField(from={"placeName"}, to="content", type="texts"),
 *     computedFields={
 *      @Solr\ComputedField(name="coordinates", type="location", getter="getCoordinates"),
 *      @Solr\ComputedField(name="sortable", type="string", getter="getSortableName()")
*     }
 * )
 */
class Place extends AbstractEntity {
    /**
     * @var string
     *
     * @ORM\Column(name="place_name", type="string", length=255, nullable=false)
     * @Solr\Field(type="text")
     */
    private $placeName;

    public function getSortableName() : string {
        return $this->placeName;
    }

    /**
     * @var string
     *
     * @Assert\Url
     * @ORM\Column(name="place_uri", type="string", length=255, nullable=true)
     */
    private $placeUri;

    /**
     * @var bool
     *
     * @ORM\Column(name="in_lake_district", type="boolean", nullable=true, options={"default": false})
     * @Solr\Field(type="string", getter="getInLakeDistrict(true)")
     */
    private $inLakeDistrict = false;

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
     * @var int
     *
     * @ORM\Column(name="region_id", type="integer", nullable=true)
     */
    private $regionId;

    /**
     * @var int
     *
     * @ORM\Column(name="country_id", type="integer", nullable=true)
     */
    private $countryId;

    /**
     * @var Collection|OtherNationalEdition[]
     * @ORM\OneToMany(targetEntity="OtherNationalEdition", mappedBy="place")
     */
    private $otherNationalEditions;

    /**
     * @var Collection|ReferencedPlace
     * @ORM\OneToMany(targetEntity="ReferencedPlace", mappedBy="place")
     */
    private $referencedPlaces;

    /**
     * @var Collection|People[]
     * @ORM\OneToMany(targetEntity="People", mappedBy="birthPlace")
     */
    private $peopleBorn;

    /**
     * @var Collection|People[]
     * @ORM\OneToMany(targetEntity="People", mappedBy="deathPlace")
     */
    private $peopleDied;

    /**
     * @var Book[]|Collection
     * @ORM\ManyToMany(targetEntity="Book", mappedBy="publicationPlaces")
     */
    private $books;

    /**
     * @var Collection|People[]
     * @ORM\ManyToMany(targetEntity="People", mappedBy="residences")
     */
    private $residents;

    /**
     * @var Collection|People[]
     * @ORM\ManyToMany(targetEntity="People", mappedBy="travels")
     */
    private $travellers;

    /**
     * Constructor.
     */
    public function __construct() {
        parent::__construct();
        $this->otherNationalEditions = new ArrayCollection();
        $this->referencedPlaces = new ArrayCollection();
        $this->peopleBorn = new ArrayCollection();
        $this->peopleDied = new ArrayCollection();
        $this->books = new ArrayCollection();
        $this->residents = new ArrayCollection();
        $this->travellers = new ArrayCollection();
    }

    /**
     * Return string representation of placeName.
     */
    public function __toString() : string {
        return $this->placeName;
    }

    /**
     * Set placeName.
     *
     * @param string $placeName
     *
     * @return Place
     */
    public function setPlaceName($placeName) {
        $this->placeName = $placeName;

        return $this;
    }

    /**
     * Get placeName.
     *
     * @return string
     */
    public function getPlaceName() {
        return $this->placeName;
    }

    /**
     * Set placeUri.
     *
     * @param string $placeUri
     *
     * @return Place
     */
    public function setPlaceUri($placeUri) {
        $this->placeUri = $placeUri;

        return $this;
    }

    /**
     * Get placeUri.
     *
     * @return string
     */
    public function getPlaceUri() {
        return $this->placeUri;
    }

    /**
     * Set inLakeDistrict.
     *
     * @param bool $inLakeDistrict
     *
     * @return Place
     */
    public function setInLakeDistrict($inLakeDistrict) {
        $this->inLakeDistrict = (bool) $inLakeDistrict;

        return $this;
    }

    /**
     * Get inLakeDistrict.
     *
     * @return bool
     */
    public function getInLakeDistrict(?bool $flat = false) {
        if($flat) {
            switch($this->inLakeDistrict) {
                case true: return 'Yes';
                case false: return 'No';
                case null: return 'Unspecified';
            }
        }
        return (bool) $this->inLakeDistrict;
    }

    public function getCoordinates() : ?string {
        if ($this->latitude && $this->longitude) {
            return $this->latitude . ',' . $this->longitude;
        }

        return null;
    }

    /**
     * Set latitude.
     *
     * @param float $latitude
     *
     * @return Place
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
     * @return Place
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

    /**
     * Set regionId.
     *
     * @param int $regionId
     *
     * @return Place
     */
    public function setRegionId($regionId) {
        $this->regionId = $regionId;

        return $this;
    }

    /**
     * Get regionId.
     *
     * @return int
     */
    public function getRegionId() {
        return $this->regionId;
    }

    /**
     * Set countryId.
     *
     * @param int $countryId
     *
     * @return Place
     */
    public function setCountryId($countryId) {
        $this->countryId = $countryId;

        return $this;
    }

    /**
     * Get countryId.
     *
     * @return int
     */
    public function getCountryId() {
        return $this->countryId;
    }

    /**
     * Add otherNationalEdition.
     *
     * @return Place
     */
    public function addOtherNationalEdition(OtherNationalEdition $otherNationalEdition) {
        $this->otherNationalEditions[] = $otherNationalEdition;

        return $this;
    }

    /**
     * Remove otherNationalEdition.
     */
    public function removeOtherNationalEdition(OtherNationalEdition $otherNationalEdition) : void {
        $this->otherNationalEditions->removeElement($otherNationalEdition);
    }

    /**
     * Get otherNationalEditions.
     *
     * @return Collection
     */
    public function getOtherNationalEditions() {
        return $this->otherNationalEditions;
    }

    /**
     * Add referencedPlace.
     *
     * @return Place
     */
    public function addReferencedPlace(ReferencedPlace $referencedPlace) {
        $this->referencedPlaces[] = $referencedPlace;

        return $this;
    }

    /**
     * Remove referencedPlace.
     */
    public function removeReferencedPlace(ReferencedPlace $referencedPlace) : void {
        $this->referencedPlaces->removeElement($referencedPlace);
    }

    /**
     * Get referencedPlaces.
     *
     * @return Collection
     */
    public function getReferencedPlaces() {
        return $this->referencedPlaces;
    }

    /**
     * Add peopleBorn.
     *
     * @return Place
     */
    public function addPeopleBorn(People $peopleBorn) {
        $this->peopleBorn[] = $peopleBorn;

        return $this;
    }

    /**
     * Remove peopleBorn.
     */
    public function removePeopleBorn(People $peopleBorn) : void {
        $this->peopleBorn->removeElement($peopleBorn);
    }

    /**
     * Get peopleBorn.
     *
     * @return Collection
     */
    public function getPeopleBorn() {
        return $this->peopleBorn;
    }

    /**
     * Add peopleDied.
     *
     * @return Place
     */
    public function addPeopleDied(People $peopleDied) {
        $this->peopleDied[] = $peopleDied;

        return $this;
    }

    /**
     * Remove peopleDied.
     */
    public function removePeopleDied(People $peopleDied) : void {
        $this->peopleDied->removeElement($peopleDied);
    }

    /**
     * Get peopleDied.
     *
     * @return Collection
     */
    public function getPeopleDied() {
        return $this->peopleDied;
    }

    /**
     * Add book.
     *
     * @param \App\Entity\Book $book
     *
     * @return Place
     */
    public function addBook(Book $book) {
        $this->books[] = $book;

        return $this;
    }

    /**
     * Remove book.
     *
     * @param \App\Entity\Book $book
     */
    public function removeBook(Book $book) : void {
        $this->books->removeElement($book);
    }

    /**
     * Get books.
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getBooks() {
        return $this->books;
    }

    /**
     * Add resident.
     *
     * @param \App\Entity\People $resident
     *
     * @return Place
     */
    public function addResident(People $resident) {
        $this->residents[] = $resident;

        return $this;
    }

    /**
     * Remove resident.
     *
     * @param \App\Entity\People $resident
     */
    public function removeResident(People $resident) : void {
        $this->residents->removeElement($resident);
    }

    /**
     * Get residents.
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getResidents() {
        return $this->residents;
    }

    /**
     * Add traveller.
     *
     * @param \App\Entity\People $traveller
     *
     * @return Place
     */
    public function addTraveller(People $traveller) {
        $this->travellers[] = $traveller;

        return $this;
    }

    /**
     * Remove traveller.
     *
     * @param \App\Entity\People $traveller
     */
    public function removeTraveller(People $traveller) : void {
        $this->travellers->removeElement($traveller);
    }

    /**
     * Get travellers.
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getTravellers() {
        return $this->travellers;
    }
}
