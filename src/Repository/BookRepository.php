<?php

declare(strict_types=1);

/*
 * (c) 2021 Michael Joyce <mjoyce@sfu.ca>
 * This source file is subject to the GPL v2, bundled
 * with this source code in the file LICENSE.
 */

namespace App\Repository;

use App\Entity\Book;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Query;
use Doctrine\Persistence\ManagerRegistry;

class BookRepository extends ServiceEntityRepository {
    public function __construct(ManagerRegistry $registry) {
        parent::__construct($registry, Book::class);
    }

    /**
     * Prepare a type-ahead query and execute it.
     *
     * @param string $q
     *
     * @return Book[]|Collection
     */
    public function typeaheadQuery($q) {
        $qb = $this->createQueryBuilder('e');
        $qb->andWhere('e.title LIKE :q');
        $qb->orderBy('e.title');
        $qb->setParameter('q', "{$q}%");

        return $qb->getQuery()->execute();
    }

    /**
     * Prepare a search query, but do not execute it.
     *
     * @param string $q
     *
     * @return Query
     */
    public function searchQuery($q) {
        $qb = $this->createQueryBuilder('e');
        $qb->addSelect('MATCH (e.title) AGAINST(:q BOOLEAN) as HIDDEN score');
        $qb->andWhere('MATCH (e.title) AGAINST(:q BOOLEAN) > 0.0');
        $qb->orderBy('score', 'DESC');
        $qb->setParameter('q', $q);

        return $qb->getQuery();
    }

    /**
     * Prepare a search query, but do not execute it.
     *
     * @param string $q
     * @param mixed $data
     *
     * @return Query
     */
    public function advancedSearchQuery($data) {
        $qb = $this->createQueryBuilder('e');
        if (isset($data['title'])) {
            $qb->addSelect('MATCH (e.title,e.shortTitle) AGAINST(:qt BOOLEAN) as HIDDEN title_score');
            $qb->andHaving('title_score > 0');
            $qb->setParameter('qt', $data['title']);
        }

        if (isset($data['publicationDate'])) {
            $m = [];
            if (preg_match('/^\s*[0-9]{4}\s*$/', $data['publicationDate'])) {
                $qb->andWhere('YEAR(e.publicationDate) = :yearb');
                $qb->setParameter('yearb', $data['publicationDate']);
            } elseif (preg_match('/^\s*(\*|[0-9]{4})\s*-\s*(\*|[0-9]{4})\s*$/', $data['publicationDate'], $m)) {
                $from = ('*' === $m[1] ? -1 : $m[1]);
                $to = ('*' === $m[2] ? 9999 : $m[2]);
                $qb->andWhere(':from <= YEAR(e.publicationDate) AND YEAR(e.publicationDate) <= :to');
                $qb->setParameter('from', $from);
                $qb->setParameter('to', $to);
            }
        }

        if (isset($data['genre'])) {
            $qb->innerJoin('e.genres', 'g');
            $qb->addSelect('MATCH(g.genreName) AGAINST (:gt BOOLEAN) as HIDDEN genre_score');
            $qb->andHaving('genre_score > 0');
            $qb->setParameter('gt', $data['genre']);
        }

        if (isset($data['keyword'])) {
            $qb->innerJoin('e.keywords', 'k');
            $qb->addSelect('MATCH(k.keyword) AGAINST (:kt BOOLEAN) as HIDDEN keyword_score');

            $qb->innerJoin('e.subjects', 's');
            $qb->addSelect('MATCH(s.subjectName) against(:kt BOOLEAN) AS HIDDEN subject_score');

            $qb->innerJoin('e.subjectHeadings', 'sh');
            $qb->addSelect('MATCH(sh.subjectHeading) against(:kt BOOLEAN) AS HIDDEN subject_heading_score');

            $qb->andHaving($qb->expr()->gt(
                $qb->expr()->sum(
                    'keyword_score',
                    $qb->expr()->sum('subject_score', 'subject_heading_score')
                ),
                '0'
            ));
            $qb->setParameter('kt', $data['keyword']);
        }

        $qb->orderBy('e.title', 'ASC');

        return $qb->getQuery()->execute();
    }
}
