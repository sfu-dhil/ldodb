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
    private $preferredKeyword = '0';

    
    public function __toString() {
        return $this->keyword;
    }

}

