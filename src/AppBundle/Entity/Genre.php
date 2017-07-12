<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Genre
 *
 * @ORM\Table(name="genre")
 * @ORM\Entity
 */
class Genre
{
    /**
     * @var integer
     *
     * @ORM\Id
     * @ORM\Column(name="genre_id", type="integer", nullable=false)
     * @ORM\GeneratedValue()
     */
    private $genreId;

    /**
     * @var string
     *
     * @ORM\Column(name="genre_name", type="string", length=255, nullable=true)
     */
    private $genreName;

    /**
     * @var string
     *
     * @ORM\Column(name="genre_source", type="string", length=255, nullable=true)
     */
    private $genreSource;

    /**
     * @var string
     *
     * @ORM\Column(name="genre_usage_note", type="text", length=16777215, nullable=true)
     */
    private $genreUsageNote;

    /**
     * @var string
     *
     * @ORM\Column(name="genre_uri", type="string", length=255, nullable=true)
     */
    private $genreUri;

    /**
     * @var integer
     *
     * @ORM\Column(name="broader_term_id", type="integer", nullable=true)
     */
    private $broaderTermId;


}

