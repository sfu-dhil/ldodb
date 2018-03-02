<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

use AppBundle\Entity\BindingFeature;
use AppBundle\Entity\MapSize;
use AppBundle\Entity\MapType;
use AppBundle\Entity\PlateType;

class DefaultController extends Controller {

    /**
     * @Route("/", name="homepage")
     * @Template()
     */
    public function indexAction(Request $request) {
        return [
            'base_dir' => realpath($this->getParameter('kernel.project_dir')) . DIRECTORY_SEPARATOR,
        ];
    }

    /**
     * @Route("/features", name="features")
     * @Template()
     */
    public function featuresAction(Request $request) {
        $em = $this->getDoctrine()->getManager();
        $qb = $em->createQueryBuilder();
        $bindingFeatures = $qb->select('bf')->from(BindingFeature::class, 'bf')->orderBy('bf.bindingFeature', 'ASC')->getQuery()->execute();
        $mapSizes = $qb->select('ms')->from(MapSize::class, 'ms')->orderBy('ms.mapSize', 'ASC')->getQuery()->execute();
        $mapTypes = $qb->select('mt')->from(MapType::class, 'mt')->orderBy('mt.mapType', 'ASC')->getQuery()->execute();
        $plateTypes = $qb->select('pt')->from(PlateType::class, 'pt')->orderBy('pt.plateType', 'ASC')->getQuery()->execute();

        return array(
            'bindingFeatures' => $bindingFeatures,
            'mapSizes' => $mapSizes,
            'mapTypes' => $mapTypes,
            'plateTypes' => $plateTypes,
        );
    }

}
