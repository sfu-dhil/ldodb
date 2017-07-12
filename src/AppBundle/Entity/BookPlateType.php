<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * BookPlateType
 *
 * @ORM\Table(name="book_plate_type")
 * @ORM\Entity
 */
class BookPlateType
{
    /**
     * @var integer
     *
     * @ORM\Column(name="plate_type_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $plateTypeId;

    /**
     * @var integer
     *
     * @ORM\Column(name="book_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $bookId;


}

