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
 * DigitalCopyHolder.
 *
 * @ORM\Table(name="digital_copy_holder")
 * @ORM\Entity(repositoryClass="App\Repository\DigitalCopyHolderRepository")
 */
class DigitalCopyHolder {
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
     * @ORM\Column(name="organization_name", type="string", length=255, nullable=false)
     */
    private $organizationName;

    /**
     * @var Book[]|Collection
     * @ORM\ManyToMany(targetEntity="Book", mappedBy="digitalCopyHolders")
     */
    private $books;

    /**
     * Construct DigitalCopyHolder object.
     */
    public function __construct() {
        $this->books = new ArrayCollection();
    }

    /**
     * Return string representation of organizationName.
     */
    public function __toString() : string {
        return $this->organizationName;
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
     * Set organizationName.
     *
     * @param string $organizationName
     *
     * @return DigitalCopyHolder
     */
    public function setOrganizationName($organizationName) {
        $this->organizationName = $organizationName;

        return $this;
    }

    /**
     * Get organizationName.
     *
     * @return string
     */
    public function getOrganizationName() {
        return $this->organizationName;
    }

    /**
     * Add book.
     *
     * @param \App\Entity\Book $book
     *
     * @return DigitalCopyHolder
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
