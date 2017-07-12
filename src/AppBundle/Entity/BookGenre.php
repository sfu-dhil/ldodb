<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * BookGenre
 *
 * @ORM\Table(name="book_genre", indexes={@ORM\Index(name="fk_books_genre_genre_idx", columns={"genre_id"}), @ORM\Index(name="fk_books_genre_books_idx", columns={"book_id"})})
 * @ORM\Entity
 */
class BookGenre
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
     * @ORM\Column(name="genre_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $genreId;


}

