<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Contribution
 *
 * @ORM\Table(name="contribution", indexes={@ORM\Index(name="fk_book_has_entity_book1_idx", columns={"contribution_book_id"}), @ORM\Index(name="fk_book_entity_task_entity1_idx", columns={"contributor_id"}), @ORM\Index(name="fk_book_entity_task_task1_idx", columns={"contribution_id"})})
 * @ORM\Entity
 */
class Contribution
{
    /**
     * @var integer
     *
     * @ORM\Id
     * @ORM\Column(name="contribution_book_id", type="integer", nullable=false)
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $contributionBookId;

    /**
     * @var integer
     *
     * @ORM\Id
     * @ORM\Column(name="contributor_id", type="integer", nullable=false)
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $contributorId;

    /**
     * @var integer
     *
     * @ORM\Id
     * @ORM\Column(name="contribution_id", type="integer", nullable=false)
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $contributionId;


}

