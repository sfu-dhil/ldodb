<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * OtherNationalEdition
 *
 * @ORM\Table(name="other_national_edition", indexes={@ORM\Index(name="fk_other_national_editions_place1_idx", columns={"place_id"})})
 * @ORM\Entity
 */
class OtherNationalEdition
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

    /**
     * @var integer
     *
     * @ORM\Column(name="publication_date", type="integer", nullable=true)
     */
    private $publicationDate;


}

