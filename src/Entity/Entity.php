<?php

declare(strict_types=1);

/*
 * (c) 2020 Michael Joyce <mjoyce@sfu.ca>
 * This source file is subject to the GPL v2, bundled
 * with this source code in the file LICENSE.
 */

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="entity")
 * @ORM\Entity(repositoryClass="App\Repository\EntityRepository")
 * @ORM\InheritanceType("JOINED")
 * @ORM\DiscriminatorColumn(name="entity_type", type="string", length=3)
 * @ORM\DiscriminatorMap({
 *      "PER" = "People",
 *      "ORG" = "Organization"
 * })
 */
abstract class Entity {
    public const PER_TYPE = 'PER';
    public const ORG_TYPE = 'ORG';

    /**
     * @var int
     *
     * @ORM\Id
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\GeneratedValue()
     */
    protected $id;

    /**
     * @var Collection|Contribution[]
     * @ORM\OneToMany(targetEntity="Contribution", mappedBy="entity")
     */
    protected $contributions;

    /**
     * Constructor.
     */
    public function __construct() {
        $this->contributions = new ArrayCollection();
    }

    /**
     * Return string representation of object.
     */
    abstract public function __toString() : string;

    /**
     * Return one of the class constants representing the type.
     */
    abstract public function getType();

    public function asString() {
        return $this->__toString();
    }

    /**
     * Get id.
     *
     * @return int
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Add contribution.
     *
     * @return Entity
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
}
