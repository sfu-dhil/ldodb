<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * BookMapSize
 *
 * @ORM\Table(name="book_map_size", indexes={@ORM\Index(name="fk_book_map_size_book_idx", columns={"book_id"})})
 * @ORM\Entity
 */
class BookMapSize
{
    /**
     * @var integer
     *
     * @ORM\Column(name="map_size_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $mapSizeId;

    /**
     * @var integer
     *
     * @ORM\Column(name="book_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $bookId;


}

