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
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\GeneratedValue()
     */
    private $id;
    
    /**
     * @var Book
     * @ORM\ManyToOne(targetEntity="Book", inversedBy="contributions")
     * @ORM\JoinColumn(name="book_id", referencedColumnName="id", nullable=false)
     */
    private $book;

    /**
     * @var Entity
     * @ORM\ManyToOne(targetEntity="Entity", inversedBy="contributions")
     * @ORM\JoinColumn(name="contributor_id", referencedColumnName="id", nullable=false)
     */
    private $entity;

    /**
     * @var Task
     * @ORM\ManyToOne(targetEntity="Task", inversedBy="contributions")
     * @ORM\JoinColumn(name="task_id", referencedColumnName="id", nullable=false)
     */
    private $task;


}

