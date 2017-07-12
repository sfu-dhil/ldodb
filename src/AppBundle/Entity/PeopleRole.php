<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * PeopleRole
 *
 * @ORM\Table(name="people_role", indexes={@ORM\Index(name="fk_people_has_role_role1_idx", columns={"role_id"})})
 * @ORM\Entity
 */
class PeopleRole
{
    /**
     * @var integer
     *
     * @ORM\Column(name="people_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $peopleId;

    /**
     * @var integer
     *
     * @ORM\Column(name="role_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $roleId;


}

