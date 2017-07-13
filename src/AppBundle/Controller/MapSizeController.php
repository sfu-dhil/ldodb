<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use AppBundle\Entity\MapSize;
use AppBundle\Form\MapSizeType;

/**
 * MapSize controller.
 *
 * @Route("/map_size")
 */
class MapSizeController extends Controller
{
    /**
     * Lists all MapSize entities.
     *
     * @Route("/", name="map_size_index")
     * @Method("GET")
     * @Template()
	 * @param Request $request
     */
    public function indexAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $dql = 'SELECT e FROM AppBundle:MapSize e ORDER BY e.id';
        $query = $em->createQuery($dql);
        $paginator = $this->get('knp_paginator');
        $mapSizes = $paginator->paginate($query, $request->query->getint('page', 1), 25);

        return array(
            'mapSizes' => $mapSizes,
        );
    }
    /**
     * Search for MapSize entities.
	 *
	 * To make this work, add a method like this one to the 
	 * AppBundle:MapSize repository. Replace the fieldName with
	 * something appropriate, and adjust the generated search.html.twig
	 * template.
	 * 
     //    public function searchQuery($q) {
     //        $qb = $this->createQueryBuilder('e');
     //        $qb->where("e.fieldName like '%$q%'");
     //        return $qb->getQuery();
     //    }
	 *
     *
     * @Route("/search", name="map_size_search")
     * @Method("GET")
     * @Template()
	 * @param Request $request
     */
    public function searchAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
		$repo = $em->getRepository('AppBundle:MapSize');
		$q = $request->query->get('q');
		if($q) {
	        $query = $repo->searchQuery($q);
			$paginator = $this->get('knp_paginator');
			$mapSizes = $paginator->paginate($query, $request->query->getInt('page', 1), 25);
		} else {
			$mapSizes = array();
		}

        return array(
            'mapSizes' => $mapSizes,
			'q' => $q,
        );
    }
    /**
     * Full text search for MapSize entities.
	 *
	 * To make this work, add a method like this one to the 
	 * AppBundle:MapSize repository. Replace the fieldName with
	 * something appropriate, and adjust the generated fulltext.html.twig
	 * template.
	 * 
	//    public function fulltextQuery($q) {
	//        $qb = $this->createQueryBuilder('e');
	//        $qb->addSelect("MATCH_AGAINST (e.name, :q 'IN BOOLEAN MODE') as score");
	//        $qb->add('where', "MATCH_AGAINST (e.name, :q 'IN BOOLEAN MODE') > 0.5");
	//        $qb->orderBy('score', 'desc');
	//        $qb->setParameter('q', $q);
	//        return $qb->getQuery();
	//    }	 
	 * 
	 * Requires a MatchAgainst function be added to doctrine, and appropriate
	 * fulltext indexes on your MapSize entity.
	 *     ORM\Index(name="alias_name_idx",columns="name", flags={"fulltext"})
	 *
     *
     * @Route("/fulltext", name="map_size_fulltext")
     * @Method("GET")
     * @Template()
	 * @param Request $request
	 * @return array
     */
    public function fulltextAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
		$repo = $em->getRepository('AppBundle:MapSize');
		$q = $request->query->get('q');
		if($q) {
	        $query = $repo->fulltextQuery($q);
			$paginator = $this->get('knp_paginator');
			$mapSizes = $paginator->paginate($query, $request->query->getInt('page', 1), 25);
		} else {
			$mapSizes = array();
		}

        return array(
            'mapSizes' => $mapSizes,
			'q' => $q,
        );
    }

    /**
     * Creates a new MapSize entity.
     *
     * @Route("/new", name="map_size_new")
     * @Method({"GET", "POST"})
     * @Template()
	 * @param Request $request
     */
    public function newAction(Request $request)
    {
        $mapSize = new MapSize();
        $form = $this->createForm('AppBundle\Form\MapSizeType', $mapSize);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($mapSize);
            $em->flush();

            $this->addFlash('success', 'The new mapSize was created.');
            return $this->redirectToRoute('map_size_show', array('id' => $mapSize->getId()));
        }

        return array(
            'mapSize' => $mapSize,
            'form' => $form->createView(),
        );
    }

    /**
     * Finds and displays a MapSize entity.
     *
     * @Route("/{id}", name="map_size_show")
     * @Method("GET")
     * @Template()
	 * @param MapSize $mapSize
     */
    public function showAction(MapSize $mapSize)
    {

        return array(
            'mapSize' => $mapSize,
        );
    }

    /**
     * Displays a form to edit an existing MapSize entity.
     *
     * @Route("/{id}/edit", name="map_size_edit")
     * @Method({"GET", "POST"})
     * @Template()
	 * @param Request $request
	 * @param MapSize $mapSize
     */
    public function editAction(Request $request, MapSize $mapSize)
    {
        $editForm = $this->createForm('AppBundle\Form\MapSizeType', $mapSize);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->flush();
            $this->addFlash('success', 'The mapSize has been updated.');
            return $this->redirectToRoute('map_size_show', array('id' => $mapSize->getId()));
        }

        return array(
            'mapSize' => $mapSize,
            'edit_form' => $editForm->createView(),
        );
    }

    /**
     * Deletes a MapSize entity.
     *
     * @Route("/{id}/delete", name="map_size_delete")
     * @Method("GET")
	 * @param Request $request
	 * @param MapSize $mapSize
     */
    public function deleteAction(Request $request, MapSize $mapSize)
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($mapSize);
        $em->flush();
        $this->addFlash('success', 'The mapSize was deleted.');

        return $this->redirectToRoute('map_size_index');
    }
}
