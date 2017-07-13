<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Task
 *
 * @ORM\Table(name="task")
 * @ORM\Entity
 */
class Task
{
    /**
     * @var integer
     *
     * @ORM\Id
     * @ORM\Column(name="task_id", type="integer", nullable=false)
     * @ORM\GeneratedValue
     */
    private $taskId;

    /**
     * @var string
     *
     * @ORM\Column(name="task_name", type="string", length=255, nullable=true)
     */
    private $taskName;

    /**
     * @var Collection|Contribution[]
     * @ORM\OneToMany(targetEntity="Contribution", mappedBy="task")
     */
    private $contributions;
}

