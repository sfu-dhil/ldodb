<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * BookMapType
 *
 * @ORM\Table(name="book_map_type", indexes={@ORM\Index(name="fk_book_map_type_book_idx", columns={"book_id"})})
 * @ORM\Entity
 */
class BookMapType
{
    /**
     * @var integer
     *
     * @ORM\Column(name="map_type_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $mapTypeId;

    /**
     * @var integer
     *
     * @ORM\Column(name="book_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $bookId;


}

