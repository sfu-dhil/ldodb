<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * OtherNationalEdition
 *
 * @ORM\Table(name="other_national_edition")
 * @ORM\Entity
 */
class OtherNationalEdition
{
    
    /**
     * @var integer
     *
     * @ORM\Id
     * @ORM\Column(name="national_edition_id", type="integer", nullable=false)
     * @ORM\GeneratedValue()
     */
    private $nationalEditionId;
    
    /**
     * @var Book
     * @ORM\ManyToOne(targetEntity="Book", inversedBy="otherNationalEditions")
     * @ORM\JoinColumn(name="book_id", referencedColumnName="book_id", nullable=false)
     */
    private $book;

    /**
     * @var Place
     * @ORM\ManyToOne(targetEntity="Place", inversedBy="otherNationalEditions")
     * @ORM\JoinColumn(name="place_id", referencedColumnName="place_id", nullable=false)
     */
    private $place;

    /**
     * @var integer
     *
     * @ORM\Column(name="publication_date", type="integer", nullable=true)
     */
    private $publicationDate;


}

