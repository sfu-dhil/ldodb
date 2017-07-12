<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * PublicationPlace
 *
 * @ORM\Table(name="publication_place", indexes={@ORM\Index(name="fk_publication_place_place_idx", columns={"place_id"}), @ORM\Index(name="fk_publication_place_book_idx", columns={"book_id"})})
 * @ORM\Entity
 */
class PublicationPlace
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
     * @ORM\Column(name="place_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $placeId;


}

