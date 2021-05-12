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

/**
 * MapType.
 *
 * @ORM\Table(name="map_type")
 * @ORM\Entity(repositoryClass="App\Repository\MapTypeRepository")
 */
class MapType {
    /**
     * @var int
     *
     * @ORM\Id
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\GeneratedValue
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="map_type", type="string", length=255, nullable=false)
     */
    private $mapType;

    /**
     * @var string
     *
     * @ORM\Column(name="map_type_notes", type="text", nullable=true)
     */
    private $mapTypeNotes;

    /**
     * @var Book[]|Collection
     * @ORM\ManyToMany(targetEntity="Book", mappedBy="mapTypes")
     */
    private $books;

    /**
     * Construct MapType object.
     */
    public function __construct() {
        $this->books = new ArrayCollection();
    }

    /**
     * Return string representation of mapType.
     */
    public function __toString() : string {
        return $this->mapType;
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
     * Set mapType.
     *
     * @param string $mapType
     *
     * @return MapType
     */
    public function setMapType($mapType) {
        $this->mapType = $mapType;

        return $this;
    }

    /**
     * Get mapType.
     *
     * @return string
     */
    public function getMapType() {
        return $this->mapType;
    }

    /**
     * Set mapTypeNotes.
     *
     * @param string $mapTypeNotes
     *
     * @return MapType
     */
    public function setMapTypeNotes($mapTypeNotes) {
        $this->mapTypeNotes = $mapTypeNotes;

        return $this;
    }

    /**
     * Get mapTypeNotes.
     *
     * @return string
     */
    public function getMapTypeNotes() {
        return $this->mapTypeNotes;
    }

    /**
     * Add book.
     *
     * @param \App\Entity\Book $book
     *
     * @return MapType
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
}
