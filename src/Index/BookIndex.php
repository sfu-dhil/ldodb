<?php

declare(strict_types=1);

/*
 * (c) 2021 Michael Joyce <mjoyce@sfu.ca>
 * This source file is subject to the GPL v2, bundled
 * with this source code in the file LICENSE.
 */

namespace App\Index;

use Nines\SolrBundle\Index\AbstractIndex;
use Solarium\QueryType\Select\Query\Query;

class BookIndex extends AbstractIndex {
    /**
     * @param $q
     * @param array $filters
     * @param array $rangeFilters
     * @param null $order
     *
     * @return Query
     */
    public function searchQuery($q, $filters = [], $rangeFilters = [], $order = null) {
        $year = date('Y');
        $qb = $this->createQueryBuilder();
        $qb->setQueryString($q);
        $qb->setDefaultField('content');

        $qb->addFilter('type', ['Book']);
        foreach ($filters as $key => $values) {
            $qb->addFilter($key, $values);
        }
        foreach ($rangeFilters as $key => $values) {
            foreach ($values as $v) {
                list($start, $end) = explode(' ', $v);
                $qb->addFilterRange($key, $start, $end);
            }
        }

        $qb->addFacetField('edition');
        $qb->addFacetField('format');
        $qb->addFacetRange('publicationDate', 1650, $year, 50);
        $qb->addFacetRange('mapCount', 0, 100, 10);
        $qb->addFacetField('illustrations');
        $qb->addFacetField('photographs');
        $qb->addFacetField('genres');

        $qb->setHighlightFields(['title', 'shortTitle', 'seriesTitle', 'imprint']);

        if ($order) {
            $qb->setSorting($order);
        }

        return $qb->getQuery();
    }
}
