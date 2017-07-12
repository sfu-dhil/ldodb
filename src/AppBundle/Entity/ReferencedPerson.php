<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ReferencedPerson
 *
 * @ORM\Table(name="referenced_person")
 * @ORM\Entity
 */
class ReferencedPerson
{
    /**
     * @var integer
     *
     * @ORM\Id
     * @ORM\Column(name="referenced_person_id", type="integer", nullable=false)
     * @ORM\GeneratedValue()
     */
    private $referencedPersonId;

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
     * @var integer
     *
     * @ORM\Column(name="same_as_people_entity_id", type="integer", nullable=true)
     */
    private $sameAsPeopleEntityId;

    /**
     * @var string
     *
     * @ORM\Column(name="referenced_person_uri", type="string", length=255, nullable=true)
     */
    private $referencedPersonUri;


}

