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
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Genre.
 *
 * @ORM\Table(name="genre", indexes={
 *     @ORM\Index(name="genre_ft_idx", columns={"genre_name"}, flags={"fulltext"})
 * })
 * @ORM\Entity(repositoryClass="App\Repository\GenreRepository")
 */
class Genre {
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
     * @ORM\Column(name="genre_name", type="string", length=255, nullable=false)
     */
    private $genreName;

    /**
     * @var string
     *
     * @ORM\Column(name="genre_source", type="string", length=255, nullable=true)
     */
    private $genreSource;

    /**
     * @var string
     *
     * @ORM\Column(name="genre_usage_note", type="text", nullable=true)
     */
    private $genreUsageNote;

    /**
     * @var string
     *
     * @Assert\Url
     * @ORM\Column(name="genre_uri", type="string", length=255, nullable=true)
     */
    private $genreUri;

    /**
     * @var int
     *
     * @ORM\Column(name="broader_term_id", type="integer", nullable=true)
     */
    private $broaderTermId;

    /**
     * @var Book[]|Collection
     * @ORM\ManyToMany(targetEntity="Book", mappedBy="genres")
     */
    private $books;

    /**
     * Construct Genre object.
     */
    public function __construct() {
        $this->books = new ArrayCollection();
    }

    /**
     * Return string representation of genreName.
     */
    public function __toString() : string {
        return $this->genreName;
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
     * Set genreName.
     *
     * @param string $genreName
     *
     * @return Genre
     */
    public function setGenreName($genreName) {
        $this->genreName = $genreName;

        return $this;
    }

    /**
     * Get genreName.
     *
     * @return string
     */
    public function getGenreName() {
        return $this->genreName;
    }

    /**
     * Set genreSource.
     *
     * @param string $genreSource
     *
     * @return Genre
     */
    public function setGenreSource($genreSource) {
        $this->genreSource = $genreSource;

        return $this;
    }

    /**
     * Get genreSource.
     *
     * @return string
     */
    public function getGenreSource() {
        return $this->genreSource;
    }

    /**
     * Set genreUsageNote.
     *
     * @param string $genreUsageNote
     *
     * @return Genre
     */
    public function setGenreUsageNote($genreUsageNote) {
        $this->genreUsageNote = $genreUsageNote;

        return $this;
    }

    /**
     * Get genreUsageNote.
     *
     * @return string
     */
    public function getGenreUsageNote() {
        return $this->genreUsageNote;
    }

    /**
     * Set genreUri.
     *
     * @param string $genreUri
     *
     * @return Genre
     */
    public function setGenreUri($genreUri) {
        $this->genreUri = $genreUri;

        return $this;
    }

    /**
     * Get genreUri.
     *
     * @return string
     */
    public function getGenreUri() {
        return $this->genreUri;
    }

    /**
     * Set broaderTermId.
     *
     * @param int $broaderTermId
     *
     * @return Genre
     */
    public function setBroaderTermId($broaderTermId) {
        $this->broaderTermId = $broaderTermId;

        return $this;
    }

    /**
     * Get broaderTermId.
     *
     * @return int
     */
    public function getBroaderTermId() {
        return $this->broaderTermId;
    }

    /**
     * Add book.
     *
     * @param \App\Entity\Book $book
     *
     * @return Genre
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
