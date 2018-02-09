<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use AppBundle\Entity\ReferencedPerson;
use AppBundle\Form\ReferencedPersonType;

/**
 * ReferencedPerson controller.
 *
 * @Route("/referenced_person")
 */
class ReferencedPersonController extends Controller {

    /**
     * Lists all ReferencedPerson entities.
     *
     * @Route("/", name="referenced_person_index")
     * @Method("GET")
     * @Template()
     * @param Request $request
     */
    public function indexAction(Request $request) {
        $em = $this->getDoctrine()->getManager();
        $qb = $em->createQueryBuilder();
        $qb->select('e')->from(ReferencedPerson::class, 'e')->orderBy('e.id', 'ASC');
        $query = $qb->getQuery();
        $paginator = $this->get('knp_paginator');
        $referencedPeople = $paginator->paginate($query, $request->query->getint('page', 1), 25);

        return array(
            'referencedPeople' => $referencedPeople,
        );
    }

    /**
     * Search for ReferencedPerson entities.
     *
     * To make this work, add a method like this one to the 
     * AppBundle:ReferencedPerson repository. Replace the fieldName with
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
     * @Route("/search", name="referenced_person_search")
     * @Method("GET")
     * @Template()
     * @param Request $request
     */
    public function searchAction(Request $request) {
        $em = $this->getDoctrine()->getManager();
        $repo = $em->getRepository('AppBundle:ReferencedPerson');
        $q = $request->query->get('q');
        if ($q) {
            $query = $repo->searchQuery($q);
            $paginator = $this->get('knp_paginator');
            $referencedPeople = $paginator->paginate($query, $request->query->getInt('page', 1), 25);
        } else {
            $referencedPeople = array();
        }

        return array(
            'referencedPeople' => $referencedPeople,
            'q' => $q,
        );
    }

    /**
     * Full text search for ReferencedPerson entities.
     *
     * To make this work, add a method like this one to the 
     * AppBundle:ReferencedPerson repository. Replace the fieldName with
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
     * fulltext indexes on your ReferencedPerson entity.
     *     ORM\Index(name="alias_name_idx",columns="name", flags={"fulltext"})
     *
     *
     * @Route("/fulltext", name="referenced_person_fulltext")
     * @Method("GET")
     * @Template()
     * @param Request $request
     * @return array
     */
    public function fulltextAction(Request $request) {
        $em = $this->getDoctrine()->getManager();
        $repo = $em->getRepository('AppBundle:ReferencedPerson');
        $q = $request->query->get('q');
        if ($q) {
            $query = $repo->fulltextQuery($q);
            $paginator = $this->get('knp_paginator');
            $referencedPeople = $paginator->paginate($query, $request->query->getInt('page', 1), 25);
        } else {
            $referencedPeople = array();
        }

        return array(
            'referencedPeople' => $referencedPeople,
            'q' => $q,
        );
    }

    /**
     * Creates a new ReferencedPerson entity.
     *
     * @Route("/new", name="referenced_person_new")
     * @Method({"GET", "POST"})
     * @Security("has_role('ROLE_CONTENT_ADMIN')")
     * @Template()
     * @param Request $request
     */
    public function newAction(Request $request) {
        $referencedPerson = new ReferencedPerson();
        $form = $this->createForm(ReferencedPersonType::class, $referencedPerson);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($referencedPerson);
            $em->flush();

            $this->addFlash('success', 'The new referencedPerson was created.');
            return $this->redirectToRoute('referenced_person_show', array('id' => $referencedPerson->getId()));
        }

        return array(
            'referencedPerson' => $referencedPerson,
            'form' => $form->createView(),
        );
    }

    /**
     * Finds and displays a ReferencedPerson entity.
     *
     * @Route("/{id}", name="referenced_person_show")
     * @Method("GET")
     * @Template()
     * @param ReferencedPerson $referencedPerson
     */
    public function showAction(ReferencedPerson $referencedPerson) {

        return array(
            'referencedPerson' => $referencedPerson,
        );
    }

    /**
     * Displays a form to edit an existing ReferencedPerson entity.
     *
     * @Route("/{id}/edit", name="referenced_person_edit")
     * @Method({"GET", "POST"})
     * @Security("has_role('ROLE_CONTENT_ADMIN')")
     * @Template()
     * @param Request $request
     * @param ReferencedPerson $referencedPerson
     */
    public function editAction(Request $request, ReferencedPerson $referencedPerson) {
        $editForm = $this->createForm(ReferencedPersonType::class, $referencedPerson);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->flush();
            $this->addFlash('success', 'The referencedPerson has been updated.');
            return $this->redirectToRoute('referenced_person_show', array('id' => $referencedPerson->getId()));
        }

        return array(
            'referencedPerson' => $referencedPerson,
            'edit_form' => $editForm->createView(),
        );
    }

    /**
     * Deletes a ReferencedPerson entity.
     *
     * @Route("/{id}/delete", name="referenced_person_delete")
     * @Method("GET")
     * @Security("has_role('ROLE_CONTENT_ADMIN')")
     * @param Request $request
     * @param ReferencedPerson $referencedPerson
     */
    public function deleteAction(Request $request, ReferencedPerson $referencedPerson) {
        $em = $this->getDoctrine()->getManager();
        $em->remove($referencedPerson);
        $em->flush();
        $this->addFlash('success', 'The referencedPerson was deleted.');

        return $this->redirectToRoute('referenced_person_index');
    }

}
