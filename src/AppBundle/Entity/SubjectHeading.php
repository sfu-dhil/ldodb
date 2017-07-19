<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * SubjectHeading
 *
 * @ORM\Table(name="subject_heading")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\SubjectHeadingRepository")
 */
class SubjectHeading
{
    /**
     * @var integer
     *
     * @ORM\Id
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\GeneratedValue()
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="subject_heading", type="string", length=255, nullable=true)
     */
    private $subjectHeading;

    /**
     * @var string
     *
     * @ORM\Column(name="subject_heading_uri", type="string", length=255, nullable=true)
     */
    private $subjectHeadingUri;

    /**
     * @var Collection|Book[]
     * @ORM\ManyToMany(targetEntity="Book", mappedBy="subjectHeadings")
     */
    private $books;
    
    public function __construct() {
        $this->books = new ArrayCollection();
    }


    public function __toString() {
        return $this->subjectHeading;
    }


    /**
     * Get id
     *
     * @return integer
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Set subjectHeading
     *
     * @param string $subjectHeading
     *
     * @return SubjectHeading
     */
    public function setSubjectHeading($subjectHeading) {
        $this->subjectHeading = $subjectHeading;

        return $this;
    }

    /**
     * Get subjectHeading
     *
     * @return string
     */
    public function getSubjectHeading() {
        return $this->subjectHeading;
    }

    /**
     * Set subjectHeadingUri
     *
     * @param string $subjectHeadingUri
     *
     * @return SubjectHeading
     */
    public function setSubjectHeadingUri($subjectHeadingUri) {
        $this->subjectHeadingUri = $subjectHeadingUri;

        return $this;
    }

    /**
     * Get subjectHeadingUri
     *
     * @return string
     */
    public function getSubjectHeadingUri() {
        return $this->subjectHeadingUri;
    }

    /**
     * Add book
     *
     * @param \AppBundle\Entity\Book $book
     *
     * @return SubjectHeading
     */
    public function addBook(\AppBundle\Entity\Book $book)
    {
        $this->books[] = $book;

        return $this;
    }

    /**
     * Remove book
     *
     * @param \AppBundle\Entity\Book $book
     */
    public function removeBook(\AppBundle\Entity\Book $book)
    {
        $this->books->removeElement($book);
    }

    /**
     * Get books
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getBooks()
    {
        return $this->books;
    }
}
