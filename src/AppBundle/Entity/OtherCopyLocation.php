<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * OtherCopyLocation
 *
 * @ORM\Table(name="other_copy_location", indexes={@ORM\Index(name="fk_other_copy_location_has_book_book1_idx", columns={"book_id"})})
 * @ORM\Entity
 */
class OtherCopyLocation
{
    /**
     * @var integer
     *
     * @ORM\Id
     * @ORM\Column(name="book_id", type="integer", nullable=false)
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $bookId;

    /**
     * @var string
     *
     * @ORM\Id
     * @ORM\Column(name="other_copy_location", type="string", length=255, nullable=false)
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $otherCopyLocation;

    /**
     * @var integer
     *
     * @ORM\Column(name="copy_count", type="integer", nullable=false)
     */
    private $copyCount;


}

