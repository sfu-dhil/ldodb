<?php

declare(strict_types=1);

/*
 * (c) 2021 Michael Joyce <mjoyce@sfu.ca>
 * This source file is subject to the GPL v2, bundled
 * with this source code in the file LICENSE.
 */

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Organization.
 *
 * @ORM\Table(name="organization", indexes={
 *     @ORM\Index(columns={"organization_name"}, flags={"fulltext"}),
 * })
 * @ORM\Entity(repositoryClass="App\Repository\OrganizationRepository")
 */
class Organization extends Entity {
    /**
     * @var string
     *
     * @ORM\Column(name="organization_name", type="string", length=255, nullable=false)
     */
    private $organizationName;

    /**
     * @var string
     *
     * @Assert\Url
     * @ORM\Column(name="organization_uri", type="string", length=255, nullable=true)
     */
    private $organizationUri;

    /**
     * @var string
     *
     * @ORM\Column(name="organization_notes", type="text", nullable=true)
     */
    private $organizationNotes;

    /**
     * Constructor.
     */
    public function __construct() {
        parent::__construct();
        $this->contributions = new ArrayCollection();
    }

    /**
     * Return string representation of organizationName.
     */
    public function __toString() : string {
        return $this->organizationName;
    }

    /**
     * Set organizationName.
     *
     * @param string $organizationName
     *
     * @return Organization
     */
    public function setOrganizationName($organizationName) {
        $this->organizationName = $organizationName;

        return $this;
    }

    /**
     * Get organizationName.
     *
     * @return string
     */
    public function getOrganizationName() {
        return $this->organizationName;
    }

    /**
     * Set organizationUri.
     *
     * @param string $organizationUri
     *
     * @return Organization
     */
    public function setOrganizationUri($organizationUri) {
        $this->organizationUri = $organizationUri;

        return $this;
    }

    /**
     * Get organizationUri.
     *
     * @return string
     */
    public function getOrganizationUri() {
        return $this->organizationUri;
    }

    /**
     * Set organizationNotes.
     *
     * @param string $organizationNotes
     *
     * @return Organization
     */
    public function setOrganizationNotes($organizationNotes) {
        $this->organizationNotes = $organizationNotes;

        return $this;
    }

    /**
     * Get organizationNotes.
     *
     * @return string
     */
    public function getOrganizationNotes() {
        return $this->organizationNotes;
    }

    /**
     * Add contribution.
     *
     * @return Organization
     */
    public function addContribution(Contribution $contribution) {
        $this->contributions[] = $contribution;

        return $this;
    }

    /**
     * Remove contribution.
     */
    public function removeContribution(Contribution $contribution) : void {
        $this->contributions->removeElement($contribution);
    }

    /**
     * Get contributions.
     *
     * @return Collection
     */
    public function getContributions() {
        return $this->contributions;
    }

    /**
     * {@inheritdoc}
     *
     * @return constant
     */
    public function getType() {
        return Entity::ORG_TYPE;
    }
}
