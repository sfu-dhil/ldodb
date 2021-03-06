<?php

declare(strict_types=1);

/*
 * (c) 2021 Michael Joyce <mjoyce@sfu.ca>
 * This source file is subject to the GPL v2, bundled
 * with this source code in the file LICENSE.
 */

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ReferencedPlace.
 *
 * @ORM\Table(name="referenced_place", indexes={
 *     @ORM\Index(columns={"variant_spelling"}, flags={"fulltext"}),
 * })
 * @ORM\Entity(repositoryClass="App\Repository\ReferencedPlaceRepository")
 */
class ReferencedPlace {
    /**
     * @var int
     *
     * @ORM\Id
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\GeneratedValue
     */
    private $id;

    /**
     * @var Book
     * @ORM\ManyToOne(targetEntity="Book", inversedBy="referencedPlaces")
     * @ORM\JoinColumn(name="book_id", referencedColumnName="id", nullable=false)
     */
    private $book;

    /**
     * @var Place
     * @ORM\ManyToOne(targetEntity="Place", inversedBy="referencedPlaces")
     * @ORM\JoinColumn(name="place_id", referencedColumnName="id", nullable=false)
     */
    private $place;

    /**
     * @var string
     *
     * @ORM\Column(name="variant_spelling", type="string", length=255, nullable=true)
     */
    private $variantSpelling;

    /**
     * Return a string representation of the object.
     */
    public function __toString() : string {
        return $this->place . ' in ' . $this->book . ($this->variantSpelling ? ' as ' . $this->variantSpelling : '');
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
     * Set variantSpelling.
     *
     * @param string $variantSpelling
     *
     * @return ReferencedPlace
     */
    public function setVariantSpelling($variantSpelling) {
        $this->variantSpelling = $variantSpelling;

        return $this;
    }

    /**
     * Get variantSpelling.
     *
     * @return string
     */
    public function getVariantSpelling() {
        return $this->variantSpelling;
    }

    /**
     * Set book.
     *
     * @return ReferencedPlace
     */
    public function setBook(Book $book) {
        $this->book = $book;

        return $this;
    }

    /**
     * Get book.
     *
     * @return Book
     */
    public function getBook() {
        return $this->book;
    }

    /**
     * Set place.
     *
     * @return ReferencedPlace
     */
    public function setPlace(Place $place) {
        $this->place = $place;

        return $this;
    }

    /**
     * Get place.
     *
     * @return Place
     */
    public function getPlace() {
        return $this->place;
    }
}
