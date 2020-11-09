<?php

declare(strict_types=1);

/*
 * (c) 2020 Michael Joyce <mjoyce@sfu.ca>
 * This source file is subject to the GPL v2, bundled
 * with this source code in the file LICENSE.
 */

namespace App\Service;

use App\Entity\Genre;
use App\Entity\Keyword;
use App\Entity\Subject;
use App\Entity\SubjectHeading;
use Doctrine\ORM\EntityManagerInterface;
use Psr\Log\LoggerInterface;

class MergeService {
    /**
     * @var LoggerInterface
     */
    private $logger;
    /**
     * @var EntityManagerInterface
     */
    private $em;

    /**
     * @param Keyword[] $keywords
     */
    public function keywords(Keyword $keyword, iterable $keywords) : void {
        foreach ($keywords as $k) {
            foreach ($k->getBooks() as $book) {
                $k->removeBook($book);
                $keyword->addBook($book);
            }
            $this->em->remove($k);
        }
        $this->em->flush();
    }

    /**
     * @param Subject[] $subjects
     */
    public function subjects(Subject $subject, iterable $subjects) {
        foreach($subjects as $s) {
            foreach($s->getBooks() as $b) {
                $s->removeBook($b);
                $subject->addBook($b);
            }
            $this->em->remove($s);
        }
        $this->em->flush();
    }

    /**
     * @param Genre[] $genres
     */
    public function genres(Genre $genre, iterable $genres) {
        foreach($genres as $g) {
            foreach($g->getBooks() as $b) {
                $g->removeBook($b);
                $genre->addBook($b);
            }
            $this->em->remove($g);
        }
        $this->em->flush();
    }

    /**
     * @param SubjectHeading[] $subjectHeadings
     */
    public function subjectHeadings(SubjectHeading $subjectHeading, iterable $subjectHeadings) {
        foreach($subjectHeadings as $s) {
            foreach($s->getBooks() as $b) {
                $s->removeBook($b);
                $subjectHeading->addBook($b);
            }
            $this->em->remove($s);
        }
        $this->em->flush();
    }

    /**
     * @required
     */
    public function setEntityManager(EntityManagerInterface $em) : void {
        $this->em = $em;
    }

    /**
     * @required
     */
    public function setLogger(LoggerInterface $logger) : void {
        $this->logger = $logger;
    }
}
