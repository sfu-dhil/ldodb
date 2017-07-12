<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * DigitalCopiesOtherInstitutions
 *
 * @ORM\Table(name="digital_copies_other_institutions", indexes={@ORM\Index(name="fk_copies_other_institutions_organization_idx", columns={"book_id"}), @ORM\Index(name="fk_copies_other_institutions_idx", columns={"organization_id"})})
 * @ORM\Entity
 */
class DigitalCopiesOtherInstitutions
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
     * @ORM\Column(name="organization_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $organizationId;


}

