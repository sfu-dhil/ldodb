<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * BookKeyword
 *
 * @ORM\Table(name="book_keyword", indexes={@ORM\Index(name="fk_book_keyword_book_idx", columns={"book_id"}), @ORM\Index(name="fk_book_keyword_keyword_idx", columns={"keyword_id"})})
 * @ORM\Entity
 */
class BookKeyword
{
    /**
     * @var integer
     *
     * @ORM\Column(name="keyword_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $keywordId;

    /**
     * @var integer
     *
     * @ORM\Column(name="book_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $bookId;


}

