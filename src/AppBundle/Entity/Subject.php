<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Subject
 *
 * @ORM\Table(name="subject", indexes={@ORM\Index(name="fk_subject_uri_idx", columns={"subject_uri"})})
 * @ORM\Entity
 */
class Subject
{
    /**
     * @var integer
     *
     * @ORM\Column(name="subject_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $subjectId;

    /**
     * @var string
     *
     * @ORM\Column(name="subject_name", type="string", length=255, nullable=true)
     */
    private $subjectName;

    /**
     * @var string
     *
     * @ORM\Column(name="subject_uri", type="string", length=255, nullable=true)
     */
    private $subjectUri;


}

