<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * SubjectHeading
 *
 * @ORM\Table(name="subject_heading")
 * @ORM\Entity
 */
class SubjectHeading
{
    /**
     * @var integer
     *
     * @ORM\Id
     * @ORM\Column(name="subject_heading_id", type="integer", nullable=false)
     * @ORM\GeneratedValue()
     */
    private $subjectHeadingId;

    /**
     * @var string
     *
     * @ORM\Column(name="subject_heading", type="string", length=255, nullable=true)
     */
    private $subjectHeading;

    /**
     * @var string
     *
     * @ORM\Column(name="subject_heading_uri", type="string", length=255, nullable=true)
     */
    private $subjectHeadingUri;


}

