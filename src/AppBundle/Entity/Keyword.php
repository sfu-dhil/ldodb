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
     * @ORM\Column(name="keyword_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $keywordId;

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


}

