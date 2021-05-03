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
 * PlateType.
 *
 * @ORM\Table(name="plate_type")
 * @ORM\Entity(repositoryClass="App\Repository\PlateTypeRepository")
 */
class PlateType {
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
     * @ORM\Column(name="plate_type", type="string", length=255, nullable=false)
     */
    private $plateType;

    /**
     * @var string
     *
     * @ORM\Column(name="plate_type_notes", type="text", nullable=true)
     */
    private $plateTypeNotes;

    /**
     * @var Book[]|Collection
     * @ORM\ManyToMany(targetEntity="Book", mappedBy="plateTypes")
     */
    private $books;

    /**
     * Construct PlateType object.
     */
    public function __construct() {
        $this->books = new ArrayCollection();
    }

    /**
     * Return string representation of plateType.
     */
    public function __toString() : string {
        return $this->plateType;
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
     * Set plateType.
     *
     * @param string $plateType
     *
     * @return PlateType
     */
    public function setPlateType($plateType) {
        $this->plateType = $plateType;

        return $this;
    }

    /**
     * Get plateType.
     *
     * @return string
     */
    public function getPlateType() {
        return $this->plateType;
    }

    /**
     * Set plateTypeNotes.
     *
     * @param string $plateTypeNotes
     *
     * @return PlateType
     */
    public function setPlateTypeNotes($plateTypeNotes) {
        $this->plateTypeNotes = $plateTypeNotes;

        return $this;
    }

    /**
     * Get plateTypeNotes.
     *
     * @return string
     */
    public function getPlateTypeNotes() {
        return $this->plateTypeNotes;
    }

    /**
     * Add book.
     *
     * @param \App\Entity\Book $book
     *
     * @return PlateType
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
