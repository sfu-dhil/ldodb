<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * SubjectHeadingBook
 *
 * @ORM\Table(name="subject_heading_book", indexes={@ORM\Index(name="subject_heading_book_book_idx", columns={"book_id"})})
 * @ORM\Entity
 */
class SubjectHeadingBook
{
    /**
     * @var integer
     *
     * @ORM\Column(name="subject_heading_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $subjectHeadingId;

    /**
     * @var integer
     *
     * @ORM\Column(name="book_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $bookId;


}

