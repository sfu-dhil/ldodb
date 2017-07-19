<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use AppBundle\Entity\BibliographicTerms;
use AppBundle\Form\BibliographicTermsType;

/**
 * BibliographicTerms controller.
 *
 * @Route("/bibliographic_term")
 */
class BibliographicTermsController extends Controller
{
    /**
     * Lists all BibliographicTerms entities.
     *
     * @Route("/", name="bibliographic_term_index")
     * @Method("GET")
     * @Template()
	 * @param Request $request
     */
    public function indexAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $qb = $em->createQueryBuilder();
        $qb->select('e')->from(BibliographicTerms::class, 'e')->orderBy('e.id', 'ASC');
        $query = $qb->getQuery();
        $paginator = $this->get('knp_paginator');
        $bibliographicTerms = $paginator->paginate($query, $request->query->getint('page', 1), 25);

        return array(
            'bibliographicTerms' => $bibliographicTerms,
        );
    }
    /**
     * Search for BibliographicTerms entities.
	 *
	 * To make this work, add a method like this one to the 
	 * AppBundle:BibliographicTerms repository. Replace the fieldName with
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
     * @Route("/search", name="bibliographic_term_search")
     * @Method("GET")
     * @Template()
	 * @param Request $request
     */
    public function searchAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
		$repo = $em->getRepository('AppBundle:BibliographicTerms');
		$q = $request->query->get('q');
		if($q) {
	        $query = $repo->searchQuery($q);
			$paginator = $this->get('knp_paginator');
			$bibliographicTerms = $paginator->paginate($query, $request->query->getInt('page', 1), 25);
		} else {
			$bibliographicTerms = array();
		}

        return array(
            'bibliographicTerms' => $bibliographicTerms,
			'q' => $q,
        );
    }
    /**
     * Full text search for BibliographicTerms entities.
	 *
	 * To make this work, add a method like this one to the 
	 * AppBundle:BibliographicTerms repository. Replace the fieldName with
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
	 * fulltext indexes on your BibliographicTerms entity.
	 *     ORM\Index(name="alias_name_idx",columns="name", flags={"fulltext"})
	 *
     *
     * @Route("/fulltext", name="bibliographic_term_fulltext")
     * @Method("GET")
     * @Template()
	 * @param Request $request
	 * @return array
     */
    public function fulltextAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
		$repo = $em->getRepository('AppBundle:BibliographicTerms');
		$q = $request->query->get('q');
		if($q) {
	        $query = $repo->fulltextQuery($q);
			$paginator = $this->get('knp_paginator');
			$bibliographicTerms = $paginator->paginate($query, $request->query->getInt('page', 1), 25);
		} else {
			$bibliographicTerms = array();
		}

        return array(
            'bibliographicTerms' => $bibliographicTerms,
			'q' => $q,
        );
    }

    /**
     * Creates a new BibliographicTerms entity.
     *
     * @Route("/new", name="bibliographic_term_new")
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
        $bibliographicTerm = new BibliographicTerms();
        $form = $this->createForm(BibliographicTermsType::class, $bibliographicTerm);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($bibliographicTerm);
            $em->flush();

            $this->addFlash('success', 'The new bibliographicTerm was created.');
            return $this->redirectToRoute('bibliographic_term_show', array('id' => $bibliographicTerm->getId()));
        }

        return array(
            'bibliographicTerm' => $bibliographicTerm,
            'form' => $form->createView(),
        );
    }

    /**
     * Finds and displays a BibliographicTerms entity.
     *
     * @Route("/{id}", name="bibliographic_term_show")
     * @Method("GET")
     * @Template()
	 * @param BibliographicTerms $bibliographicTerm
     */
    public function showAction(BibliographicTerms $bibliographicTerm)
    {

        return array(
            'bibliographicTerm' => $bibliographicTerm,
        );
    }

    /**
     * Displays a form to edit an existing BibliographicTerms entity.
     *
     * @Route("/{id}/edit", name="bibliographic_term_edit")
     * @Method({"GET", "POST"})
     * @Template()
	 * @param Request $request
	 * @param BibliographicTerms $bibliographicTerm
     */
    public function editAction(Request $request, BibliographicTerms $bibliographicTerm)
    {
        if( ! $this->isGranted('ROLE_CONTENT_ADMIN')) {
            $this->addFlash('danger', 'You must login to access this page.');
            return $this->redirect($this->generateUrl('fos_user_security_login'));
        }
        $editForm = $this->createForm(BibliographicTermsType::class, $bibliographicTerm);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->flush();
            $this->addFlash('success', 'The bibliographicTerm has been updated.');
            return $this->redirectToRoute('bibliographic_term_show', array('id' => $bibliographicTerm->getId()));
        }

        return array(
            'bibliographicTerm' => $bibliographicTerm,
            'edit_form' => $editForm->createView(),
        );
    }

    /**
     * Deletes a BibliographicTerms entity.
     *
     * @Route("/{id}/delete", name="bibliographic_term_delete")
     * @Method("GET")
	 * @param Request $request
	 * @param BibliographicTerms $bibliographicTerm
     */
    public function deleteAction(Request $request, BibliographicTerms $bibliographicTerm)
    {
        if( ! $this->isGranted('ROLE_CONTENT_ADMIN')) {
            $this->addFlash('danger', 'You must login to access this page.');
            return $this->redirect($this->generateUrl('fos_user_security_login'));
        }
        $em = $this->getDoctrine()->getManager();
        $em->remove($bibliographicTerm);
        $em->flush();
        $this->addFlash('success', 'The bibliographicTerm was deleted.');

        return $this->redirectToRoute('bibliographic_term_index');
    }
}
