<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * BookSubject
 *
 * @ORM\Table(name="book_subject", indexes={@ORM\Index(name="fk_books_subject_subject_idx", columns={"subject_id"}), @ORM\Index(name="fk_books_subject_books_idx", columns={"book_id"})})
 * @ORM\Entity
 */
class BookSubject
{
    /**
     * @var integer
     *
     * @ORM\Column(name="book_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $bookId;

    /**
     * @var integer
     *
     * @ORM\Column(name="subject_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $subjectId;


}

