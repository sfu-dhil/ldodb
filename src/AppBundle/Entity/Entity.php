<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="entity")
 * @ORM\Entity
 * @ORM\InheritanceType("JOINED")
 * @ORM\DiscriminatorColumn(name="entity_type", type="string", length=3)
 * @ORM\DiscriminatorMap({
 *      "PER" = "People",
 *      "ORG" = "Organization"
 * })
 */
abstract class Entity
{
    /**
     * @var integer
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
    
    abstract public function __toString();

}
