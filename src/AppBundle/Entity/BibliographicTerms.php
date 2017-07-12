<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * BibliographicTerms
 *
 * @ORM\Table(name="bibliographic_terms")
 * @ORM\Entity
 */
class BibliographicTerms
{
    /**
     * @var integer
     *
     * @ORM\Column(name="bibliographic_terms_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $bibliographicTermsId;

    /**
     * @var string
     *
     * @ORM\Column(name="bibliographic_term", type="string", length=255, nullable=true)
     */
    private $bibliographicTerm;

    /**
     * @var boolean
     *
     * @ORM\Column(name="use_for_format", type="boolean", nullable=true)
     */
    private $useForFormat;

    /**
     * @var boolean
     *
     * @ORM\Column(name="use_for_photographs", type="boolean", nullable=true)
     */
    private $useForPhotographs;

    /**
     * @var boolean
     *
     * @ORM\Column(name="use_for_illustrations", type="boolean", nullable=true)
     */
    private $useForIllustrations;


}

