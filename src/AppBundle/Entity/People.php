<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * People
 *
 * @ORM\Table(name="people", indexes={@ORM\Index(name="fk_people_place1_idx", columns={"birth_place_id"}), @ORM\Index(name="fk_people_place2_idx", columns={"death_place_id"}), @ORM\Index(name="fk_people_uri_idx", columns={"people_uri"}), @ORM\Index(name="fk_people_entity1_idx", columns={"people_entity_id"}), @ORM\Index(name="people_id_UNIQUE", columns={"people_id"})})
 * @ORM\Entity
 */
class People
{

    /**
     * @var integer
     *
     * @ORM\Column(name="people_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $peopleId;
    
    /**
     * @var integer
     *
     * @ORM\Column(name="people_entity_id", type="integer", nullable=false, options={"default": 0})
     */
    private $peopleEntityId = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="last_name", type="string", length=255, nullable=true)
     */
    private $lastName;

    /**
     * @var string
     *
     * @ORM\Column(name="first_name", type="string", length=255, nullable=true)
     */
    private $firstName;

    /**
     * @var string
     *
     * @ORM\Column(name="other_last_name", type="string", length=255, nullable=true)
     */
    private $otherLastName;

    /**
     * @var string
     *
     * @ORM\Column(name="other_first_name", type="string", length=255, nullable=true)
     */
    private $otherFirstName;

    /**
     * @var string
     *
     * @ORM\Column(name="birth_date", type="string", length=255, nullable=true)
     */
    private $birthDate;

    /**
     * @var string
     *
     * @ORM\Column(name="death_date", type="string", length=255, nullable=true)
     */
    private $deathDate;

    /**
     * @var string
     *
     * @ORM\Column(name="gender", type="text", length=255, nullable=true)
     */
    private $gender;

    /**
     * @var string
     *
     * @ORM\Column(name="biographical_notes", type="text", nullable=true)
     */
    private $biographicalNotes;

    /**
     * @var string
     *
     * @ORM\Column(name="biographical_annotation", type="text", nullable=true)
     */
    private $biographicalAnnotation;

    /**
     * @var integer
     *
     * @ORM\Column(name="birth_place_id", type="integer", nullable=true)
     */
    private $birthPlaceId;

    /**
     * @var integer
     *
     * @ORM\Column(name="death_place_id", type="integer", nullable=true)
     */
    private $deathPlaceId;

    /**
     * @var string
     *
     * @ORM\Column(name="nationality", type="string", length=255, nullable=true)
     */
    private $nationality;

    /**
     * @var string
     *
     * @ORM\Column(name="people_uri", type="string", length=255, nullable=true)
     */
    private $peopleUri;

    /**
     * @var boolean
     *
     * @ORM\Column(name="resident_in_LD", type="boolean", nullable=true, options={"default": false})
     */
    private $residentInLd = '0';

    /**
     * @var boolean
     *
     * @ORM\Column(name="resident_in_London", type="boolean", nullable=true, options={"default": false})
     */
    private $residentInLondon = '0';

    /**
     * @var boolean
     *
     * @ORM\Column(name="resident_outside_UK", type="boolean", nullable=true, options={"default": false})
     */
    private $residentOutsideUk = '0';

    /**
     * @var boolean
     *
     * @ORM\Column(name="travel_outside_UK", type="boolean", nullable=true, options={"default": false})
     */
    private $travelOutsideUk = '0';


}

