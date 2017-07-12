<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Book
 *
 * @ORM\Table(name="book", indexes={@ORM\Index(name="fk_book_uri_idx", columns={"book_uri"}), @ORM\Index(name="book_format_idx", columns={"format"})})
 * @ORM\Entity
 */
class Book
{
    /**
     * @var integer
     *
     * @ORM\Column(name="book_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $bookId;

    /**
     * @var string
     *
     * @ORM\Column(name="file_name", type="string", length=255, nullable=true)
     */
    private $fileName;

    /**
     * @var string
     *
     * @ORM\Column(name="call_number", type="string", length=255, nullable=true)
     */
    private $callNumber;

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="text", length=16777215, nullable=true)
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(name="short_title", type="text", length=16777215, nullable=true)
     */
    private $shortTitle;

    /**
     * @var string
     *
     * @ORM\Column(name="series_title", type="text", length=16777215, nullable=true)
     */
    private $seriesTitle;

    /**
     * @var string
     *
     * @ORM\Column(name="title_page_quotation", type="text", length=16777215, nullable=true)
     */
    private $titlePageQuotation;

    /**
     * @var string
     *
     * @ORM\Column(name="dedication", type="text", length=16777215, nullable=true)
     */
    private $dedication;

    /**
     * @var string
     *
     * @ORM\Column(name="imprint", type="text", length=16777215, nullable=true)
     */
    private $imprint;

    /**
     * @var string
     *
     * @ORM\Column(name="edition", type="string", length=20, nullable=true)
     */
    private $edition;

    /**
     * @var string
     *
     * @ORM\Column(name="publication_date", type="string", length=20, nullable=true)
     */
    private $publicationDate;

    /**
     * @var integer
     *
     * @ORM\Column(name="volumes", type="integer", nullable=true, options={"default": 1})
     */
    private $volumes = '1';

    /**
     * @var integer
     *
     * @ORM\Column(name="pages", type="integer", nullable=true)
     */
    private $pages;

    /**
     * @var integer
     *
     * @ORM\Column(name="copies", type="integer", nullable=true, options={"default": 1})
     */
    private $copies = '1';

    /**
     * @var string
     *
     * @ORM\Column(name="SFU_cat_orig_bib", type="text", length=16777215, nullable=true)
     */
    private $sfuCatOrigBib;

    /**
     * @var boolean
     *
     * @ORM\Column(name="original_bib", type="boolean", nullable=true, options={"default": 0})
     */
    private $originalBib = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="bicknell_number", type="string", length=10, nullable=true)
     */
    private $bicknellNumber;

    /**
     * @var string
     *
     * @ORM\Column(name="healey_number", type="string", length=10, nullable=true)
     */
    private $healeyNumber;

    /**
     * @var string
     *
     * @ORM\Column(name="reed_number", type="string", length=10, nullable=true)
     */
    private $reedNumber;

    /**
     * @var boolean
     *
     * @ORM\Column(name="public_domain", type="boolean", nullable=true, options={"default": 0})
     */
    private $publicDomain = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="british_edition", type="string", length=255, nullable=true)
     */
    private $britishEdition;

    /**
     * @var string
     *
     * @ORM\Column(name="price", type="string", length=255, nullable=true)
     */
    private $price;

    /**
     * @var integer
     *
     * @ORM\Column(name="print_run", type="integer", nullable=true)
     */
    private $printRun;

    /**
     * @var string
     *
     * @ORM\Column(name="book_uri", type="string", length=255, nullable=true)
     */
    private $bookUri;

    /**
     * @var string
     *
     * @ORM\Column(name="digital_object_url", type="text", length=16777215, nullable=true)
     */
    private $digitalObjectUrl;

    /**
     * @var string
     *
     * @ORM\Column(name="bibliographic_notes", type="text", length=16777215, nullable=true)
     */
    private $bibliographicNotes;

    /**
     * @var string
     *
     * @ORM\Column(name="critical_annotation", type="text", length=16777215, nullable=true)
     */
    private $criticalAnnotation;

    /**
     * @var string
     *
     * @ORM\Column(name="format", type="string", length=255, nullable=true)
     */
    private $format;

    /**
     * @var integer
     *
     * @ORM\Column(name="plate_count", type="integer", nullable=true, options={"default": 0})
     */
    private $plateCount = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="map_count", type="integer", nullable=true, options={"default": 0})
     */
    private $mapCount = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="illustrations", type="string", length=255, nullable=true)
     */
    private $illustrations;

    /**
     * @var string
     *
     * @ORM\Column(name="photographs", type="string", length=255, nullable=true)
     */
    private $photographs;

    /**
     * @var boolean
     *
     * @ORM\Column(name="tables", type="boolean", nullable=true)
     */
    private $tables;

    /**
     * @var string
     *
     * @ORM\Column(name="binding_colour", type="text", length=16777215, nullable=true)
     */
    private $bindingColour;


}

