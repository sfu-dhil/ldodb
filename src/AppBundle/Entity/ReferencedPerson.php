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
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\GeneratedValue()
     */
    private $id;

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


    public function __toString() {
        return $this->lastName . ', ' . $this->firstName;
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
     * Set lastName
     *
     * @param string $lastName
     *
     * @return ReferencedPerson
     */
    public function setLastName($lastName) {
        $this->lastName = $lastName;

        return $this;
    }

    /**
     * Get lastName
     *
     * @return string
     */
    public function getLastName() {
        return $this->lastName;
    }

    /**
     * Set firstName
     *
     * @param string $firstName
     *
     * @return ReferencedPerson
     */
    public function setFirstName($firstName) {
        $this->firstName = $firstName;

        return $this;
    }

    /**
     * Get firstName
     *
     * @return string
     */
    public function getFirstName() {
        return $this->firstName;
    }

    /**
     * Set birthDate
     *
     * @param string $birthDate
     *
     * @return ReferencedPerson
     */
    public function setBirthDate($birthDate) {
        $this->birthDate = $birthDate;

        return $this;
    }

    /**
     * Get birthDate
     *
     * @return string
     */
    public function getBirthDate() {
        return $this->birthDate;
    }

    /**
     * Set deathDate
     *
     * @param string $deathDate
     *
     * @return ReferencedPerson
     */
    public function setDeathDate($deathDate) {
        $this->deathDate = $deathDate;

        return $this;
    }

    /**
     * Get deathDate
     *
     * @return string
     */
    public function getDeathDate() {
        return $this->deathDate;
    }

    /**
     * Set sameAsPeopleEntityId
     *
     * @param integer $sameAsPeopleEntityId
     *
     * @return ReferencedPerson
     */
    public function setSameAsPeopleEntityId($sameAsPeopleEntityId) {
        $this->sameAsPeopleEntityId = $sameAsPeopleEntityId;

        return $this;
    }

    /**
     * Get sameAsPeopleEntityId
     *
     * @return integer
     */
    public function getSameAsPeopleEntityId() {
        return $this->sameAsPeopleEntityId;
    }

    /**
     * Set referencedPersonUri
     *
     * @param string $referencedPersonUri
     *
     * @return ReferencedPerson
     */
    public function setReferencedPersonUri($referencedPersonUri) {
        $this->referencedPersonUri = $referencedPersonUri;

        return $this;
    }

    /**
     * Get referencedPersonUri
     *
     * @return string
     */
    public function getReferencedPersonUri() {
        return $this->referencedPersonUri;
    }
}
