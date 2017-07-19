<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use AppBundle\Entity\SupplementalPlaceData;
use AppBundle\Form\SupplementalPlaceDataType;

/**
 * SupplementalPlaceData controller.
 *
 * @Route("/supplemental_place_data")
 */
class SupplementalPlaceDataController extends Controller
{
    /**
     * Lists all SupplementalPlaceData entities.
     *
     * @Route("/", name="supplemental_place_data_index")
     * @Method("GET")
     * @Template()
	 * @param Request $request
     */
    public function indexAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $qb = $em->createQueryBuilder();
        $qb->select('e')->from(SupplementalPlaceData::class, 'e')->orderBy('e.id', 'ASC');
        $query = $qb->getQuery();
        $paginator = $this->get('knp_paginator');
        $supplementalPlaceDatas = $paginator->paginate($query, $request->query->getint('page', 1), 25);

        return array(
            'supplementalPlaceDatas' => $supplementalPlaceDatas,
        );
    }
    /**
     * Search for SupplementalPlaceData entities.
	 *
	 * To make this work, add a method like this one to the 
	 * AppBundle:SupplementalPlaceData repository. Replace the fieldName with
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
     * @Route("/search", name="supplemental_place_data_search")
     * @Method("GET")
     * @Template()
	 * @param Request $request
     */
    public function searchAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
		$repo = $em->getRepository('AppBundle:SupplementalPlaceData');
		$q = $request->query->get('q');
		if($q) {
	        $query = $repo->searchQuery($q);
			$paginator = $this->get('knp_paginator');
			$supplementalPlaceDatas = $paginator->paginate($query, $request->query->getInt('page', 1), 25);
		} else {
			$supplementalPlaceDatas = array();
		}

        return array(
            'supplementalPlaceDatas' => $supplementalPlaceDatas,
			'q' => $q,
        );
    }
    /**
     * Full text search for SupplementalPlaceData entities.
	 *
	 * To make this work, add a method like this one to the 
	 * AppBundle:SupplementalPlaceData repository. Replace the fieldName with
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
	 * fulltext indexes on your SupplementalPlaceData entity.
	 *     ORM\Index(name="alias_name_idx",columns="name", flags={"fulltext"})
	 *
     *
     * @Route("/fulltext", name="supplemental_place_data_fulltext")
     * @Method("GET")
     * @Template()
	 * @param Request $request
	 * @return array
     */
    public function fulltextAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
		$repo = $em->getRepository('AppBundle:SupplementalPlaceData');
		$q = $request->query->get('q');
		if($q) {
	        $query = $repo->fulltextQuery($q);
			$paginator = $this->get('knp_paginator');
			$supplementalPlaceDatas = $paginator->paginate($query, $request->query->getInt('page', 1), 25);
		} else {
			$supplementalPlaceDatas = array();
		}

        return array(
            'supplementalPlaceDatas' => $supplementalPlaceDatas,
			'q' => $q,
        );
    }

    /**
     * Creates a new SupplementalPlaceData entity.
     *
     * @Route("/new", name="supplemental_place_data_new")
     * @Method({"GET", "POST"})
     * @Template()
	 * @param Request $request
     */
    public function newAction(Request $request)
    {
        if( ! $this->isGranted('ROLE_CONTENT_ADMIN')) {
            $this->addFlash('danger', 'You must login to access this page.');
            return $this->redirect($this->generateUrl('fos_user_security_login'));
        }
        $supplementalPlaceDatum = new SupplementalPlaceData();
        $form = $this->createForm(SupplementalPlaceDataType::class, $supplementalPlaceDatum);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($supplementalPlaceDatum);
            $em->flush();

            $this->addFlash('success', 'The new supplementalPlaceDatum was created.');
            return $this->redirectToRoute('supplemental_place_data_show', array('id' => $supplementalPlaceDatum->getId()));
        }

        return array(
            'supplementalPlaceDatum' => $supplementalPlaceDatum,
            'form' => $form->createView(),
        );
    }

    /**
     * Finds and displays a SupplementalPlaceData entity.
     *
     * @Route("/{id}", name="supplemental_place_data_show")
     * @Method("GET")
     * @Template()
	 * @param SupplementalPlaceData $supplementalPlaceDatum
     */
    public function showAction(SupplementalPlaceData $supplementalPlaceDatum)
    {

        return array(
            'supplementalPlaceDatum' => $supplementalPlaceDatum,
        );
    }

    /**
     * Displays a form to edit an existing SupplementalPlaceData entity.
     *
     * @Route("/{id}/edit", name="supplemental_place_data_edit")
     * @Method({"GET", "POST"})
     * @Template()
	 * @param Request $request
	 * @param SupplementalPlaceData $supplementalPlaceDatum
     */
    public function editAction(Request $request, SupplementalPlaceData $supplementalPlaceDatum)
    {
        if( ! $this->isGranted('ROLE_CONTENT_ADMIN')) {
            $this->addFlash('danger', 'You must login to access this page.');
            return $this->redirect($this->generateUrl('fos_user_security_login'));
        }
        $editForm = $this->createForm(SupplementalPlaceDataType::class, $supplementalPlaceDatum);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->flush();
            $this->addFlash('success', 'The supplementalPlaceDatum has been updated.');
            return $this->redirectToRoute('supplemental_place_data_show', array('id' => $supplementalPlaceDatum->getId()));
        }

        return array(
            'supplementalPlaceDatum' => $supplementalPlaceDatum,
            'edit_form' => $editForm->createView(),
        );
    }

    /**
     * Deletes a SupplementalPlaceData entity.
     *
     * @Route("/{id}/delete", name="supplemental_place_data_delete")
     * @Method("GET")
	 * @param Request $request
	 * @param SupplementalPlaceData $supplementalPlaceDatum
     */
    public function deleteAction(Request $request, SupplementalPlaceData $supplementalPlaceDatum)
    {
        if( ! $this->isGranted('ROLE_CONTENT_ADMIN')) {
            $this->addFlash('danger', 'You must login to access this page.');
            return $this->redirect($this->generateUrl('fos_user_security_login'));
        }
        $em = $this->getDoctrine()->getManager();
        $em->remove($supplementalPlaceDatum);
        $em->flush();
        $this->addFlash('success', 'The supplementalPlaceDatum was deleted.');

        return $this->redirectToRoute('supplemental_place_data_index');
    }
}
