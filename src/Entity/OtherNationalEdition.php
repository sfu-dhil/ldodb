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
 * OtherNationalEdition.
 *
 * @ORM\Table(name="other_national_edition")
 * @ORM\Entity(repositoryClass="App\Repository\OtherNationalEditionRepository")
 */
class OtherNationalEdition
{
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
     * @ORM\ManyToOne(targetEntity="Book", inversedBy="otherNationalEditions")
     * @ORM\JoinColumn(name="book_id", referencedColumnName="id", nullable=false)
     */
    private $book;

    /**
     * @var Place
     * @ORM\ManyToOne(targetEntity="Place", inversedBy="otherNationalEditions")
     * @ORM\JoinColumn(name="place_id", referencedColumnName="id", nullable=false)
     */
    private $place;

    /**
     * @var int
     *
     * @ORM\Column(name="publication_date", type="integer", nullable=true)
     */
    private $publicationDate;

    /**
     * Return string representation of object.
     */
    public function __toString() : string {
        return $this->place->__toString() . ', ' . $this->publicationDate;
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
     * Set publicationDate.
     *
     * @param int $publicationDate
     *
     * @return OtherNationalEdition
     */
    public function setPublicationDate($publicationDate) {
        $this->publicationDate = $publicationDate;

        return $this;
    }

    /**
     * Get publicationDate.
     *
     * @return int
     */
    public function getPublicationDate() {
        return $this->publicationDate;
    }

    /**
     * Set book.
     *
     * @return OtherNationalEdition
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
     * @return OtherNationalEdition
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
