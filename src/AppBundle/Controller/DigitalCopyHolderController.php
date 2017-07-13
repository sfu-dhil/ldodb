<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use AppBundle\Entity\DigitalCopyHolder;
use AppBundle\Form\DigitalCopyHolderType;

/**
 * DigitalCopyHolder controller.
 *
 * @Route("/digital_copy_holder")
 */
class DigitalCopyHolderController extends Controller
{
    /**
     * Lists all DigitalCopyHolder entities.
     *
     * @Route("/", name="digital_copy_holder_index")
     * @Method("GET")
     * @Template()
	 * @param Request $request
     */
    public function indexAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $dql = 'SELECT e FROM AppBundle:DigitalCopyHolder e ORDER BY e.id';
        $query = $em->createQuery($dql);
        $paginator = $this->get('knp_paginator');
        $digitalCopyHolders = $paginator->paginate($query, $request->query->getint('page', 1), 25);

        return array(
            'digitalCopyHolders' => $digitalCopyHolders,
        );
    }
    /**
     * Search for DigitalCopyHolder entities.
	 *
	 * To make this work, add a method like this one to the 
	 * AppBundle:DigitalCopyHolder repository. Replace the fieldName with
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
     * @Route("/search", name="digital_copy_holder_search")
     * @Method("GET")
     * @Template()
	 * @param Request $request
     */
    public function searchAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
		$repo = $em->getRepository('AppBundle:DigitalCopyHolder');
		$q = $request->query->get('q');
		if($q) {
	        $query = $repo->searchQuery($q);
			$paginator = $this->get('knp_paginator');
			$digitalCopyHolders = $paginator->paginate($query, $request->query->getInt('page', 1), 25);
		} else {
			$digitalCopyHolders = array();
		}

        return array(
            'digitalCopyHolders' => $digitalCopyHolders,
			'q' => $q,
        );
    }
    /**
     * Full text search for DigitalCopyHolder entities.
	 *
	 * To make this work, add a method like this one to the 
	 * AppBundle:DigitalCopyHolder repository. Replace the fieldName with
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
	 * fulltext indexes on your DigitalCopyHolder entity.
	 *     ORM\Index(name="alias_name_idx",columns="name", flags={"fulltext"})
	 *
     *
     * @Route("/fulltext", name="digital_copy_holder_fulltext")
     * @Method("GET")
     * @Template()
	 * @param Request $request
	 * @return array
     */
    public function fulltextAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
		$repo = $em->getRepository('AppBundle:DigitalCopyHolder');
		$q = $request->query->get('q');
		if($q) {
	        $query = $repo->fulltextQuery($q);
			$paginator = $this->get('knp_paginator');
			$digitalCopyHolders = $paginator->paginate($query, $request->query->getInt('page', 1), 25);
		} else {
			$digitalCopyHolders = array();
		}

        return array(
            'digitalCopyHolders' => $digitalCopyHolders,
			'q' => $q,
        );
    }

    /**
     * Creates a new DigitalCopyHolder entity.
     *
     * @Route("/new", name="digital_copy_holder_new")
     * @Method({"GET", "POST"})
     * @Template()
	 * @param Request $request
     */
    public function newAction(Request $request)
    {
        $digitalCopyHolder = new DigitalCopyHolder();
        $form = $this->createForm('AppBundle\Form\DigitalCopyHolderType', $digitalCopyHolder);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($digitalCopyHolder);
            $em->flush();

            $this->addFlash('success', 'The new digitalCopyHolder was created.');
            return $this->redirectToRoute('digital_copy_holder_show', array('id' => $digitalCopyHolder->getId()));
        }

        return array(
            'digitalCopyHolder' => $digitalCopyHolder,
            'form' => $form->createView(),
        );
    }

    /**
     * Finds and displays a DigitalCopyHolder entity.
     *
     * @Route("/{id}", name="digital_copy_holder_show")
     * @Method("GET")
     * @Template()
	 * @param DigitalCopyHolder $digitalCopyHolder
     */
    public function showAction(DigitalCopyHolder $digitalCopyHolder)
    {

        return array(
            'digitalCopyHolder' => $digitalCopyHolder,
        );
    }

    /**
     * Displays a form to edit an existing DigitalCopyHolder entity.
     *
     * @Route("/{id}/edit", name="digital_copy_holder_edit")
     * @Method({"GET", "POST"})
     * @Template()
	 * @param Request $request
	 * @param DigitalCopyHolder $digitalCopyHolder
     */
    public function editAction(Request $request, DigitalCopyHolder $digitalCopyHolder)
    {
        $editForm = $this->createForm('AppBundle\Form\DigitalCopyHolderType', $digitalCopyHolder);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->flush();
            $this->addFlash('success', 'The digitalCopyHolder has been updated.');
            return $this->redirectToRoute('digital_copy_holder_show', array('id' => $digitalCopyHolder->getId()));
        }

        return array(
            'digitalCopyHolder' => $digitalCopyHolder,
            'edit_form' => $editForm->createView(),
        );
    }

    /**
     * Deletes a DigitalCopyHolder entity.
     *
     * @Route("/{id}/delete", name="digital_copy_holder_delete")
     * @Method("GET")
	 * @param Request $request
	 * @param DigitalCopyHolder $digitalCopyHolder
     */
    public function deleteAction(Request $request, DigitalCopyHolder $digitalCopyHolder)
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($digitalCopyHolder);
        $em->flush();
        $this->addFlash('success', 'The digitalCopyHolder was deleted.');

        return $this->redirectToRoute('digital_copy_holder_index');
    }
}
