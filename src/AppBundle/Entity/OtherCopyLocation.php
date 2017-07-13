<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * OtherCopyLocation
 *
 * @ORM\Table(name="other_copy_location")
 * @ORM\Entity
 */
class OtherCopyLocation
{
    /**
     * @var integer
     *
     * @ORM\Id
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\GeneratedValue()
     */
    private $id;
    
    /**
     * @var Book
     * @ORM\ManyToOne(targetEntity="Book", inversedBy="otherCopyLocations")
     * @ORM\JoinColumn(name="book_id", referencedColumnName="id", nullable=false)
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

    public function __toString() {
        return $this->otherCopyLocation . ' (' . $this->copyCount . ')';
    }

}

