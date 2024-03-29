<?php

declare(strict_types=1);

/*
 * (c) 2021 Michael Joyce <mjoyce@sfu.ca>
 * This source file is subject to the GPL v2, bundled
 * with this source code in the file LICENSE.
 */

namespace App\Controller;

use App\Entity\BindingFeature;
use App\Entity\MapSize;
use App\Entity\MapType;
use App\Entity\PlateType;
use App\Index\DefaultIndex;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Bundle\PaginatorBundle\Definition\PaginatorAwareInterface;
use Nines\BlogBundle\Repository\PageRepository;
use Nines\SolrBundle\Services\SolrManager;
use Nines\UtilBundle\Controller\PaginatorTrait;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends AbstractController implements PaginatorAwareInterface {
    use PaginatorTrait;

    /**
     * @Route("/", name="homepage", methods={"GET"})
     * @Template
     */
    public function indexAction(Request $request, PageRepository $repo) {
        $homepage = $repo->findHomepage();

        return [
            'homepage' => $homepage,
        ];
    }

    /**
     * @Route("/features", name="homepage_features")
     * @Template
     */
    public function featuresAction(Request $request, EntityManagerInterface $em) {
        $qb = $em->createQueryBuilder();
        $bindingFeatures = $qb->select('bf')->from(BindingFeature::class, 'bf')->orderBy('bf.bindingFeature', 'ASC')->getQuery()->execute();
        $mapSizes = $qb->select('ms')->from(MapSize::class, 'ms')->orderBy('ms.mapSize', 'ASC')->getQuery()->execute();
        $mapTypes = $qb->select('mt')->from(MapType::class, 'mt')->orderBy('mt.mapType', 'ASC')->getQuery()->execute();
        $plateTypes = $qb->select('pt')->from(PlateType::class, 'pt')->orderBy('pt.plateType', 'ASC')->getQuery()->execute();

        return [
            'bindingFeatures' => $bindingFeatures,
            'mapSizes' => $mapSizes,
            'mapTypes' => $mapTypes,
            'plateTypes' => $plateTypes,
        ];
    }

    /**
     * @Route("/search", name="search")
     * @Template
     */
    public function searchAction(Request $request, DefaultIndex $index, SolrManager $solr) {
        $q = $request->query->get('q');
        $result = null;
        if ($q) {
            $order = null;
            $filters = $request->query->get('filter', []);
            $m = [];
            if (preg_match('/^(\\w+).(asc|desc)$/', $request->query->get('order', 'score.desc'), $m)) {
                $order = [$m[1] => $m[2]];
            } else {
                $order = ['score' => 'desc'];
            }

            $query = $index->searchQuery($q, $filters, $order);
            $result = $solr->execute($query, $this->paginator, [
                'page' => (int) $request->query->get('page', 1),
                'pageSize' => (int) $this->getParameter('page_size'),
            ]);
        }

        return [
            'q' => $q,
            'result' => $result,
        ];
    }

    /**
     * @Route("/privacy", name="privacy", methods={"GET"})
     * @Template
     */
    public function privacyAction(Request $request) : void {
    }
}
