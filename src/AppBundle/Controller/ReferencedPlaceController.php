<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use AppBundle\Entity\ReferencedPlace;
use AppBundle\Form\ReferencedPlaceType;

/**
 * ReferencedPlace controller.
 *
 * @Route("/referenced_place")
 */
class ReferencedPlaceController extends Controller {

    /**
     * Lists all ReferencedPlace entities.
     *
     * @Route("/", name="referenced_place_index")
     * @Method("GET")
     * @Template()
     * @param Request $request
     */
    public function indexAction(Request $request) {
        $em = $this->getDoctrine()->getManager();
        $qb = $em->createQueryBuilder();
        $qb->select('e')->from(ReferencedPlace::class, 'e')->orderBy('e.place', 'ASC');
        $query = $qb->getQuery();
        $paginator = $this->get('knp_paginator');
        $referencedPlaces = $paginator->paginate($query, $request->query->getint('page', 1), 25);

        return array(
            'referencedPlaces' => $referencedPlaces,
        );
    }

    /**
     * Search for ReferencedPlace entities.
     *
     * To make this work, add a method like this one to the 
     * AppBundle:ReferencedPlace repository. Replace the fieldName with
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
     * @Route("/search", name="referenced_place_search")
     * @Method("GET")
     * @Template()
     * @param Request $request
     */
    public function searchAction(Request $request) {
        $em = $this->getDoctrine()->getManager();
        $repo = $em->getRepository('AppBundle:ReferencedPlace');
        $q = $request->query->get('q');
        if ($q) {
            $query = $repo->searchQuery($q);
            $paginator = $this->get('knp_paginator');
            $referencedPlaces = $paginator->paginate($query, $request->query->getInt('page', 1), 25);
        } else {
            $referencedPlaces = array();
        }

        return array(
            'referencedPlaces' => $referencedPlaces,
            'q' => $q,
        );
    }

    /**
     * Full text search for ReferencedPlace entities.
     *
     * To make this work, add a method like this one to the 
     * AppBundle:ReferencedPlace repository. Replace the fieldName with
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
     * fulltext indexes on your ReferencedPlace entity.
     *     ORM\Index(name="alias_name_idx",columns="name", flags={"fulltext"})
     *
     *
     * @Route("/fulltext", name="referenced_place_fulltext")
     * @Method("GET")
     * @Template()
     * @param Request $request
     * @return array
     */
    public function fulltextAction(Request $request) {
        $em = $this->getDoctrine()->getManager();
        $repo = $em->getRepository('AppBundle:ReferencedPlace');
        $q = $request->query->get('q');
        if ($q) {
            $query = $repo->fulltextQuery($q);
            $paginator = $this->get('knp_paginator');
            $referencedPlaces = $paginator->paginate($query, $request->query->getInt('page', 1), 25);
        } else {
            $referencedPlaces = array();
        }

        return array(
            'referencedPlaces' => $referencedPlaces,
            'q' => $q,
        );
    }

    /**
     * Creates a new ReferencedPlace entity.
     *
     * @Route("/new", name="referenced_place_new")
     * @Method({"GET", "POST"})
     * @Security("has_role('ROLE_CONTENT_ADMIN')")
     * @Template()
     * @param Request $request
     */
    public function newAction(Request $request) {
        $referencedPlace = new ReferencedPlace();
        $form = $this->createForm(ReferencedPlaceType::class, $referencedPlace);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($referencedPlace);
            $em->flush();

            $this->addFlash('success', 'The new referencedPlace was created.');
            return $this->redirectToRoute('referenced_place_show', array('id' => $referencedPlace->getId()));
        }

        return array(
            'referencedPlace' => $referencedPlace,
            'form' => $form->createView(),
        );
    }

    /**
     * Finds and displays a ReferencedPlace entity.
     *
     * @Route("/{id}", name="referenced_place_show")
     * @Method("GET")
     * @Template()
     * @param ReferencedPlace $referencedPlace
     */
    public function showAction(ReferencedPlace $referencedPlace) {

        return array(
            'referencedPlace' => $referencedPlace,
        );
    }

    /**
     * Displays a form to edit an existing ReferencedPlace entity.
     *
     * @Route("/{id}/edit", name="referenced_place_edit")
     * @Method({"GET", "POST"})
     * @Template()
     * @Security("has_role('ROLE_CONTENT_ADMIN')")
     * @param Request $request
     * @param ReferencedPlace $referencedPlace
     */
    public function editAction(Request $request, ReferencedPlace $referencedPlace) {
        $editForm = $this->createForm(ReferencedPlaceType::class, $referencedPlace);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->flush();
            $this->addFlash('success', 'The referencedPlace has been updated.');
            return $this->redirectToRoute('referenced_place_show', array('id' => $referencedPlace->getId()));
        }

        return array(
            'referencedPlace' => $referencedPlace,
            'edit_form' => $editForm->createView(),
        );
    }

    /**
     * Deletes a ReferencedPlace entity.
     *
     * @Route("/{id}/delete", name="referenced_place_delete")
     * @Method("GET")
     * @Security("has_role('ROLE_CONTENT_ADMIN')")
     * @param Request $request
     * @param ReferencedPlace $referencedPlace
     */
    public function deleteAction(Request $request, ReferencedPlace $referencedPlace) {
        $em = $this->getDoctrine()->getManager();
        $em->remove($referencedPlace);
        $em->flush();
        $this->addFlash('success', 'The referencedPlace was deleted.');

        return $this->redirectToRoute('referenced_place_index');
    }

}
