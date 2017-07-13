<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use AppBundle\Entity\OtherNationalEdition;
use AppBundle\Form\OtherNationalEditionType;

/**
 * OtherNationalEdition controller.
 *
 * @Route("/other_national_edition")
 */
class OtherNationalEditionController extends Controller
{
    /**
     * Lists all OtherNationalEdition entities.
     *
     * @Route("/", name="other_national_edition_index")
     * @Method("GET")
     * @Template()
	 * @param Request $request
     */
    public function indexAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $dql = 'SELECT e FROM AppBundle:OtherNationalEdition e ORDER BY e.id';
        $query = $em->createQuery($dql);
        $paginator = $this->get('knp_paginator');
        $otherNationalEditions = $paginator->paginate($query, $request->query->getint('page', 1), 25);

        return array(
            'otherNationalEditions' => $otherNationalEditions,
        );
    }
    /**
     * Search for OtherNationalEdition entities.
	 *
	 * To make this work, add a method like this one to the 
	 * AppBundle:OtherNationalEdition repository. Replace the fieldName with
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
     * @Route("/search", name="other_national_edition_search")
     * @Method("GET")
     * @Template()
	 * @param Request $request
     */
    public function searchAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
		$repo = $em->getRepository('AppBundle:OtherNationalEdition');
		$q = $request->query->get('q');
		if($q) {
	        $query = $repo->searchQuery($q);
			$paginator = $this->get('knp_paginator');
			$otherNationalEditions = $paginator->paginate($query, $request->query->getInt('page', 1), 25);
		} else {
			$otherNationalEditions = array();
		}

        return array(
            'otherNationalEditions' => $otherNationalEditions,
			'q' => $q,
        );
    }
    /**
     * Full text search for OtherNationalEdition entities.
	 *
	 * To make this work, add a method like this one to the 
	 * AppBundle:OtherNationalEdition repository. Replace the fieldName with
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
	 * fulltext indexes on your OtherNationalEdition entity.
	 *     ORM\Index(name="alias_name_idx",columns="name", flags={"fulltext"})
	 *
     *
     * @Route("/fulltext", name="other_national_edition_fulltext")
     * @Method("GET")
     * @Template()
	 * @param Request $request
	 * @return array
     */
    public function fulltextAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
		$repo = $em->getRepository('AppBundle:OtherNationalEdition');
		$q = $request->query->get('q');
		if($q) {
	        $query = $repo->fulltextQuery($q);
			$paginator = $this->get('knp_paginator');
			$otherNationalEditions = $paginator->paginate($query, $request->query->getInt('page', 1), 25);
		} else {
			$otherNationalEditions = array();
		}

        return array(
            'otherNationalEditions' => $otherNationalEditions,
			'q' => $q,
        );
    }

    /**
     * Creates a new OtherNationalEdition entity.
     *
     * @Route("/new", name="other_national_edition_new")
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
        $otherNationalEdition = new OtherNationalEdition();
        $form = $this->createForm('AppBundle\Form\OtherNationalEditionType', $otherNationalEdition);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($otherNationalEdition);
            $em->flush();

            $this->addFlash('success', 'The new otherNationalEdition was created.');
            return $this->redirectToRoute('other_national_edition_show', array('id' => $otherNationalEdition->getId()));
        }

        return array(
            'otherNationalEdition' => $otherNationalEdition,
            'form' => $form->createView(),
        );
    }

    /**
     * Finds and displays a OtherNationalEdition entity.
     *
     * @Route("/{id}", name="other_national_edition_show")
     * @Method("GET")
     * @Template()
	 * @param OtherNationalEdition $otherNationalEdition
     */
    public function showAction(OtherNationalEdition $otherNationalEdition)
    {

        return array(
            'otherNationalEdition' => $otherNationalEdition,
        );
    }

    /**
     * Displays a form to edit an existing OtherNationalEdition entity.
     *
     * @Route("/{id}/edit", name="other_national_edition_edit")
     * @Method({"GET", "POST"})
     * @Template()
	 * @param Request $request
	 * @param OtherNationalEdition $otherNationalEdition
     */
    public function editAction(Request $request, OtherNationalEdition $otherNationalEdition)
    {
        if( ! $this->isGranted('ROLE_CONTENT_ADMIN')) {
            $this->addFlash('danger', 'You must login to access this page.');
            return $this->redirect($this->generateUrl('fos_user_security_login'));
        }
        $editForm = $this->createForm('AppBundle\Form\OtherNationalEditionType', $otherNationalEdition);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->flush();
            $this->addFlash('success', 'The otherNationalEdition has been updated.');
            return $this->redirectToRoute('other_national_edition_show', array('id' => $otherNationalEdition->getId()));
        }

        return array(
            'otherNationalEdition' => $otherNationalEdition,
            'edit_form' => $editForm->createView(),
        );
    }

    /**
     * Deletes a OtherNationalEdition entity.
     *
     * @Route("/{id}/delete", name="other_national_edition_delete")
     * @Method("GET")
	 * @param Request $request
	 * @param OtherNationalEdition $otherNationalEdition
     */
    public function deleteAction(Request $request, OtherNationalEdition $otherNationalEdition)
    {
        if( ! $this->isGranted('ROLE_CONTENT_ADMIN')) {
            $this->addFlash('danger', 'You must login to access this page.');
            return $this->redirect($this->generateUrl('fos_user_security_login'));
        }
        $em = $this->getDoctrine()->getManager();
        $em->remove($otherNationalEdition);
        $em->flush();
        $this->addFlash('success', 'The otherNationalEdition was deleted.');

        return $this->redirectToRoute('other_national_edition_index');
    }
}
