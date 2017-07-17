<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Keyword
 *
 * @ORM\Table(name="keyword")
 * @ORM\Entity
 */
class Keyword
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
     * @ORM\Column(name="keyword", type="string", length=255, nullable=true)
     */
    private $keyword;

    /**
     * @var boolean
     *
     * @ORM\Column(name="preferred_keyword", type="boolean", nullable=true, options={"default": 0})
     */
    private $preferredKeyword = false;


    public function __toString() {
        return $this->keyword;
    }


    /**
     * Get id
     *
     * @return integer
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Set keyword
     *
     * @param string $keyword
     *
     * @return Keyword
     */
    public function setKeyword($keyword) {
        $this->keyword = $keyword;

        return $this;
    }

    /**
     * Get keyword
     *
     * @return string
     */
    public function getKeyword() {
        return $this->keyword;
    }

    /**
     * Set preferredKeyword
     *
     * @param boolean $preferredKeyword
     *
     * @return Keyword
     */
    public function setPreferredKeyword($preferredKeyword) {
        $this->preferredKeyword = (bool)$preferredKeyword;

        return $this;
    }

    /**
     * Get preferredKeyword
     *
     * @return boolean
     */
    public function getPreferredKeyword() {
        return (bool)$this->preferredKeyword;
    }
}
