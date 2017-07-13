<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * People
 *
 * @ORM\Table(name="people")
 * @ORM\Entity
 */
class People extends Entity
{

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
     * @var Place
     * @ORM\ManyToOne(targetEntity="Place", inversedBy="peopleBorn")
     * @ORM\JoinColumn(name="birth_place_id", referencedColumnName="id", nullable=true)
     */
    private $birthPlace;

    /**
     * @var Place
     * @ORM\ManyToOne(targetEntity="Place", inversedBy="peopleDied")
     * @ORM\JoinColumn(name="death_place_id", referencedColumnName="id", nullable=true)
     */
    private $deathPlace;

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

    /**
     * @var Collection|Place[]
     * @ORM\ManyToMany(targetEntity="Place")
     * @ORM\JoinTable(name="places_of_travel", 
     *  joinColumns={@ORM\JoinColumn(name="entity_id", referencedColumnName="id")},
     *  inverseJoinColumns={@ORM\JoinColumn(name="place_id", referencedColumnName="id")}
     * )
     */
    private $travels;
    
    /**
     * @var Collection|Place[]
     * @ORM\ManyToMany(targetEntity="Place")
     * @ORM\JoinTable(name="residence_place", 
     *  joinColumns={@ORM\JoinColumn(name="entity_id", referencedColumnName="id")},
     *  inverseJoinColumns={@ORM\JoinColumn(name="place_id", referencedColumnName="id")}
     * )
     */
    private $residences;
    
    /**
     * @var Collection|Role[]
     * @ORM\ManyToMany(targetEntity="Role")
     * @ORM\JoinTable(name="people_role", 
     *  joinColumns={@ORM\JoinColumn(name="entity_id", referencedColumnName="id")},
     *  inverseJoinColumns={@ORM\JoinColumn(name="role_id", referencedColumnName="id")}
     * )
     */
    private $roles;
    
    public function __toString() {
        return $this->lastName . ', ' . $this->firstName;
    }
    
}

