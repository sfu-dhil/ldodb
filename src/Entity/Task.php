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
 * Task.
 *
 * @ORM\Table(name="task")
 * @ORM\Entity(repositoryClass="App\Repository\TaskRepository")
 */
class Task {
    /**
     * @var int
     *
     * @ORM\Id
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\GeneratedValue
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="task_name", type="string", length=255, nullable=false)
     */
    private $taskName;

    /**
     * @var Collection|Contribution[]
     * @ORM\OneToMany(targetEntity="Contribution", mappedBy="task")
     */
    private $contributions;

    /**
     * Constructor.
     */
    public function __construct() {
        $this->contributions = new ArrayCollection();
    }

    /**
     * Return string representation of taskName.
     */
    public function __toString() : string {
        return $this->taskName;
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
     * Set taskName.
     *
     * @param string $taskName
     *
     * @return Task
     */
    public function setTaskName($taskName) {
        $this->taskName = $taskName;

        return $this;
    }

    /**
     * Get taskName.
     *
     * @return string
     */
    public function getTaskName() {
        return $this->taskName;
    }

    /**
     * Add contribution.
     *
     * @return Task
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
