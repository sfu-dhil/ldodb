<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ReferencedPlace
 *
 * @ORM\Table(name="referenced_place", indexes={@ORM\Index(name="fk_referenced_place_place_idx", columns={"place_id"}), @ORM\Index(name="fk_referenced_place_book_idx", columns={"book_id"})})
 * @ORM\Entity
 */
class ReferencedPlace
{
    /**
     * @var integer
     *
     * @ORM\Id
     * @ORM\Column(name="referenced_place_id", type="integer", nullable=false)
     * @ORM\GeneratedValue()
     */
    private $referencedPlaceId;
    
    /**
     * @var Book
     * @ORM\ManyToOne(targetEntity="Book", inversedBy="referencedPlaces")
     * @ORM\JoinColumn(name="book_id", referencedColumnName="book_id", nullable=false)
     */
    private $book;

    /**
     * @var Place
     * @ORM\ManyToOne(targetEntity="Place", inversedBy="referencedPlaces")
     * @ORM\JoinColumn(name="place_id", referencedColumnName="place_id", nullable=false)
     */
    private $place;

    /**
     * @var string
     *
     * @ORM\Column(name="variant_spelling", type="string", length=255, nullable=true)
     */
    private $variantSpelling;


}

