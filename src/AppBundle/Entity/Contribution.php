<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Contribution
 *
 * @ORM\Table(name="contribution")
 * @ORM\Entity
 */
class Contribution
{
   /**
     * @var integer
     *
     * @ORM\Id
     * @ORM\Column(name="contribution_id", type="integer", nullable=false)
     * @ORM\GeneratedValue()
     */
    private $contributionId;
    
    /**
     * @var Book
     * @ORM\ManyToOne(targetEntity="Book", inversedBy="contributions")
     * @ORM\JoinColumn(name="book_id", referencedColumnName="book_id", nullable=false)
     */
    private $book;

    /**
     * @var integer
     *
     * @ORM\Column(name="contributor_id", type="integer", nullable=false)
     */
    private $contributorId;

    /**
     * @var Task
     * @ORM\ManyToOne(targetEntity="Task", inversedBy="contributions")
     * @ORM\JoinColumn(name="task_id", referencedColumnName="task_id", nullable=false)
     */
    private $task;


}

