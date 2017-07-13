<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Subject
 *
 * @ORM\Table(name="subject")
 * @ORM\Entity
 */
class Subject
{
    /**
     * @var integer
     *
     * @ORM\Id
     * @ORM\Column(name="subject_id", type="integer", nullable=false)
     * @ORM\GeneratedValue()
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

