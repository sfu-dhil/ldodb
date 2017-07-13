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
     * @ORM\Column(name="other_location_id", type="integer", nullable=false)
     * @ORM\GeneratedValue()
     */
    private $otherCopyLocationId;
    
    /**
     * @var Book
     * @ORM\ManyToOne(targetEntity="Book", inversedBy="otherCopyLocations")
     * @ORM\JoinColumn(name="book_id", referencedColumnName="book_id", nullable=false)
     */
    private $book;

    /**
     * @var string
     *
     * @ORM\Column(name="other_copy_location", type="string", length=255, nullable=false)
     */
    private $otherCopyLocation;

    /**
     * @var integer
     *
     * @ORM\Column(name="copy_count", type="integer", nullable=false)
     */
    private $copyCount;


}

