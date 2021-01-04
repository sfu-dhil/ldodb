<?php

declare(strict_types=1);

/*
 * (c) 2020 Michael Joyce <mjoyce@sfu.ca>
 * This source file is subject to the GPL v2, bundled
 * with this source code in the file LICENSE.
 */

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Contribution.
 *
 * @ORM\Table(name="contribution")
 * @ORM\Entity(repositoryClass="App\Repository\ContributionRepository")
 */
class Contribution {
    /**
     * @var int
     *
     * @ORM\Id
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\GeneratedValue
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

    /**
     * Return string representation of object.
     *
     * Formatted as task of book, e.g. "Author of Book Title"
     */
    public function __toString() : string {
        return $this->task . ' of ' . $this->book;
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
     * Set book.
     *
     * @return Contribution
     */
    public function setBook(Book $book) {
        $this->book = $book;

        return $this;
    }

    /**
     * Get book.
     *
     * @return Book
     */
    public function getBook() {
        return $this->book;
    }

    /**
     * Set entity.
     *
     * @return Contribution
     */
    public function setEntity(Entity $entity) {
        $this->entity = $entity;

        return $this;
    }

    /**
     * Get entity.
     *
     * @return Entity
     */
    public function getEntity() {
        return $this->entity;
    }

    /**
     * Set task.
     *
     * @return Contribution
     */
    public function setTask(Task $task) {
        $this->task = $task;

        return $this;
    }

    /**
     * Get task.
     *
     * @return Task
     */
    public function getTask() {
        return $this->task;
    }
}
