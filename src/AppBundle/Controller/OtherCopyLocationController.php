<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use AppBundle\Entity\OtherCopyLocation;
use AppBundle\Form\OtherCopyLocationType;

/**
 * OtherCopyLocation controller.
 *
 * @Route("/other_copy_location")
 */
class OtherCopyLocationController extends Controller
{
    /**
     * Lists all OtherCopyLocation entities.
     *
     * @Route("/", name="other_copy_location_index")
     * @Method("GET")
     * @Template()
	 * @param Request $request
     */
    public function indexAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $dql = 'SELECT e FROM AppBundle:OtherCopyLocation e ORDER BY e.id';
        $query = $em->createQuery($dql);
        $paginator = $this->get('knp_paginator');
        $otherCopyLocations = $paginator->paginate($query, $request->query->getint('page', 1), 25);

        return array(
            'otherCopyLocations' => $otherCopyLocations,
        );
    }
    /**
     * Search for OtherCopyLocation entities.
	 *
	 * To make this work, add a method like this one to the 
	 * AppBundle:OtherCopyLocation repository. Replace the fieldName with
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
     * @Route("/search", name="other_copy_location_search")
     * @Method("GET")
     * @Template()
	 * @param Request $request
     */
    public function searchAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
		$repo = $em->getRepository('AppBundle:OtherCopyLocation');
		$q = $request->query->get('q');
		if($q) {
	        $query = $repo->searchQuery($q);
			$paginator = $this->get('knp_paginator');
			$otherCopyLocations = $paginator->paginate($query, $request->query->getInt('page', 1), 25);
		} else {
			$otherCopyLocations = array();
		}

        return array(
            'otherCopyLocations' => $otherCopyLocations,
			'q' => $q,
        );
    }
    /**
     * Full text search for OtherCopyLocation entities.
	 *
	 * To make this work, add a method like this one to the 
	 * AppBundle:OtherCopyLocation repository. Replace the fieldName with
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
	 * fulltext indexes on your OtherCopyLocation entity.
	 *     ORM\Index(name="alias_name_idx",columns="name", flags={"fulltext"})
	 *
     *
     * @Route("/fulltext", name="other_copy_location_fulltext")
     * @Method("GET")
     * @Template()
	 * @param Request $request
	 * @return array
     */
    public function fulltextAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
		$repo = $em->getRepository('AppBundle:OtherCopyLocation');
		$q = $request->query->get('q');
		if($q) {
	        $query = $repo->fulltextQuery($q);
			$paginator = $this->get('knp_paginator');
			$otherCopyLocations = $paginator->paginate($query, $request->query->getInt('page', 1), 25);
		} else {
			$otherCopyLocations = array();
		}

        return array(
            'otherCopyLocations' => $otherCopyLocations,
			'q' => $q,
        );
    }

    /**
     * Creates a new OtherCopyLocation entity.
     *
     * @Route("/new", name="other_copy_location_new")
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
        $otherCopyLocation = new OtherCopyLocation();
        $form = $this->createForm(AppBundle\Form\OtherCopyLocationType::class, $otherCopyLocation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($otherCopyLocation);
            $em->flush();

            $this->addFlash('success', 'The new otherCopyLocation was created.');
            return $this->redirectToRoute('other_copy_location_show', array('id' => $otherCopyLocation->getId()));
        }

        return array(
            'otherCopyLocation' => $otherCopyLocation,
            'form' => $form->createView(),
        );
    }

    /**
     * Finds and displays a OtherCopyLocation entity.
     *
     * @Route("/{id}", name="other_copy_location_show")
     * @Method("GET")
     * @Template()
	 * @param OtherCopyLocation $otherCopyLocation
     */
    public function showAction(OtherCopyLocation $otherCopyLocation)
    {

        return array(
            'otherCopyLocation' => $otherCopyLocation,
        );
    }

    /**
     * Displays a form to edit an existing OtherCopyLocation entity.
     *
     * @Route("/{id}/edit", name="other_copy_location_edit")
     * @Method({"GET", "POST"})
     * @Template()
	 * @param Request $request
	 * @param OtherCopyLocation $otherCopyLocation
     */
    public function editAction(Request $request, OtherCopyLocation $otherCopyLocation)
    {
        if( ! $this->isGranted('ROLE_CONTENT_ADMIN')) {
            $this->addFlash('danger', 'You must login to access this page.');
            return $this->redirect($this->generateUrl('fos_user_security_login'));
        }
        $editForm = $this->createForm(AppBundle\Form\OtherCopyLocationType::class, $otherCopyLocation);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->flush();
            $this->addFlash('success', 'The otherCopyLocation has been updated.');
            return $this->redirectToRoute('other_copy_location_show', array('id' => $otherCopyLocation->getId()));
        }

        return array(
            'otherCopyLocation' => $otherCopyLocation,
            'edit_form' => $editForm->createView(),
        );
    }

    /**
     * Deletes a OtherCopyLocation entity.
     *
     * @Route("/{id}/delete", name="other_copy_location_delete")
     * @Method("GET")
	 * @param Request $request
	 * @param OtherCopyLocation $otherCopyLocation
     */
    public function deleteAction(Request $request, OtherCopyLocation $otherCopyLocation)
    {
        if( ! $this->isGranted('ROLE_CONTENT_ADMIN')) {
            $this->addFlash('danger', 'You must login to access this page.');
            return $this->redirect($this->generateUrl('fos_user_security_login'));
        }
        $em = $this->getDoctrine()->getManager();
        $em->remove($otherCopyLocation);
        $em->flush();
        $this->addFlash('success', 'The otherCopyLocation was deleted.');

        return $this->redirectToRoute('other_copy_location_index');
    }
}
