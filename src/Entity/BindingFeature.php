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
 * BindingFeature.
 *
 * @ORM\Table(name="binding_feature")
 * @ORM\Entity(repositoryClass="App\Repository\BindingFeatureRepository")
 */
class BindingFeature
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
     * @ORM\Column(name="binding_feature", type="string", length=255, nullable=false)
     */
    private $bindingFeature;

    /**
     * @var string
     *
     * @ORM\Column(name="binding_feature_notes", type="text", nullable=true)
     */
    private $bindingFeatureNotes;

    /**
     * @var Book[]|Collection
     * @ORM\ManyToMany(targetEntity="Book", mappedBy="bindingFeatures")
     */
    private $books;

    /**
     * Construct BindingFeature object.
     */
    public function __construct() {
        $this->books = new ArrayCollection();
    }

    /**
     * Return string representation of bindingFeature.
     */
    public function __toString() : string {
        return $this->bindingFeature;
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
     * Set bindingFeature.
     *
     * @param string $bindingFeature
     *
     * @return BindingFeature
     */
    public function setBindingFeature($bindingFeature) {
        $this->bindingFeature = $bindingFeature;

        return $this;
    }

    /**
     * Get bindingFeature.
     *
     * @return string
     */
    public function getBindingFeature() {
        return $this->bindingFeature;
    }

    /**
     * Set bindingFeatureNotes.
     *
     * @param string $bindingFeatureNotes
     *
     * @return BindingFeature
     */
    public function setBindingFeatureNotes($bindingFeatureNotes) {
        $this->bindingFeatureNotes = $bindingFeatureNotes;

        return $this;
    }

    /**
     * Get bindingFeatureNotes.
     *
     * @return string
     */
    public function getBindingFeatureNotes() {
        return $this->bindingFeatureNotes;
    }

    /**
     * Add book.
     *
     * @param \App\Entity\Book $book
     *
     * @return BindingFeature
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
