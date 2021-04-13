<?php

declare(strict_types=1);

/*
 * (c) 2020 Michael Joyce <mjoyce@sfu.ca>
 * This source file is subject to the GPL v2, bundled
 * with this source code in the file LICENSE.
 */

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * MapSize.
 *
 * @ORM\Table(name="map_size")
 * @ORM\Entity(repositoryClass="App\Repository\MapSizeRepository")
 */
class MapSize
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
     * @var string
     *
     * @ORM\Column(name="map_size", type="string", length=255, nullable=false)
     */
    private $mapSize;

    /**
     * @var string
     *
     * @ORM\Column(name="map_size_notes", type="text", nullable=true)
     */
    private $mapSizeNotes;

    /**
     * @var Book[]|Collection
     * @ORM\ManyToMany(targetEntity="Book", mappedBy="mapSizes")
     */
    private $books;

    /**
     * Construct MapSize object.
     */
    public function __construct() {
        $this->books = new ArrayCollection();
    }

    /**
     * Return string representation of mapSize.
     */
    public function __toString() : string {
        return $this->mapSize ? $this->mapSize : '';
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
     * Set mapSize.
     *
     * @param string $mapSize
     *
     * @return MapSize
     */
    public function setMapSize($mapSize) {
        $this->mapSize = $mapSize;

        return $this;
    }

    /**
     * Get mapSize.
     *
     * @return string
     */
    public function getMapSize() {
        return $this->mapSize;
    }

    /**
     * Set mapSizeNotes.
     *
     * @param string $mapSizeNotes
     *
     * @return MapSize
     */
    public function setMapSizeNotes($mapSizeNotes) {
        $this->mapSizeNotes = $mapSizeNotes;

        return $this;
    }

    /**
     * Get mapSizeNotes.
     *
     * @return string
     */
    public function getMapSizeNotes() {
        return $this->mapSizeNotes;
    }

    /**
     * Add book.
     *
     * @param \App\Entity\Book $book
     *
     * @return MapSize
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
