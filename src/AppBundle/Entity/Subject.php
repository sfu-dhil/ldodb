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
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\GeneratedValue()
     */
    private $id;

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

    
    public function __toString() {
        return $this->subjectName;
    }


    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set subjectName
     *
     * @param string $subjectName
     *
     * @return Subject
     */
    public function setSubjectName($subjectName)
    {
        $this->subjectName = $subjectName;

        return $this;
    }

    /**
     * Get subjectName
     *
     * @return string
     */
    public function getSubjectName()
    {
        return $this->subjectName;
    }

    /**
     * Set subjectUri
     *
     * @param string $subjectUri
     *
     * @return Subject
     */
    public function setSubjectUri($subjectUri)
    {
        $this->subjectUri = $subjectUri;

        return $this;
    }

    /**
     * Get subjectUri
     *
     * @return string
     */
    public function getSubjectUri()
    {
        return $this->subjectUri;
    }
}
