<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use AppBundle\Entity\SubjectHeading;
use AppBundle\Form\SubjectHeadingType;

/**
 * SubjectHeading controller.
 *
 * @Route("/subject_heading")
 */
class SubjectHeadingController extends Controller {

    /**
     * Lists all SubjectHeading entities.
     *
     * @Route("/", name="subject_heading_index")
     * @Method("GET")
     * @Template()
     * @param Request $request
     */
    public function indexAction(Request $request) {
        $em = $this->getDoctrine()->getManager();
        $qb = $em->createQueryBuilder();
        $qb->select('e')->from(SubjectHeading::class, 'e')->orderBy('e.subjectHeading', 'ASC');
        $query = $qb->getQuery();
        $paginator = $this->get('knp_paginator');
        $subjectHeadings = $paginator->paginate($query, $request->query->getint('page', 1), 25);

        return array(
            'subjectHeadings' => $subjectHeadings,
        );
    }

    /**
     * Search for SubjectHeading entities.
     *
     * To make this work, add a method like this one to the 
     * AppBundle:SubjectHeading repository. Replace the fieldName with
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
     * @Route("/search", name="subject_heading_search")
     * @Method("GET")
     * @Template()
     * @param Request $request
     */
    public function searchAction(Request $request) {
        $em = $this->getDoctrine()->getManager();
        $repo = $em->getRepository('AppBundle:SubjectHeading');
        $q = $request->query->get('q');
        if ($q) {
            $query = $repo->searchQuery($q);
            $paginator = $this->get('knp_paginator');
            $subjectHeadings = $paginator->paginate($query, $request->query->getInt('page', 1), 25);
        } else {
            $subjectHeadings = array();
        }

        return array(
            'subjectHeadings' => $subjectHeadings,
            'q' => $q,
        );
    }

    /**
     * Full text search for SubjectHeading entities.
     *
     * To make this work, add a method like this one to the 
     * AppBundle:SubjectHeading repository. Replace the fieldName with
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
     * fulltext indexes on your SubjectHeading entity.
     *     ORM\Index(name="alias_name_idx",columns="name", flags={"fulltext"})
     *
     *
     * @Route("/fulltext", name="subject_heading_fulltext")
     * @Method("GET")
     * @Template()
     * @param Request $request
     * @return array
     */
    public function fulltextAction(Request $request) {
        $em = $this->getDoctrine()->getManager();
        $repo = $em->getRepository('AppBundle:SubjectHeading');
        $q = $request->query->get('q');
        if ($q) {
            $query = $repo->fulltextQuery($q);
            $paginator = $this->get('knp_paginator');
            $subjectHeadings = $paginator->paginate($query, $request->query->getInt('page', 1), 25);
        } else {
            $subjectHeadings = array();
        }

        return array(
            'subjectHeadings' => $subjectHeadings,
            'q' => $q,
        );
    }

    /**
     * Creates a new SubjectHeading entity.
     *
     * @Route("/new", name="subject_heading_new")
     * @Method({"GET", "POST"})
     * @Security("has_role('ROLE_CONTENT_ADMIN')")
     * @Template()
     * @param Request $request
     */
    public function newAction(Request $request) {
        $subjectHeading = new SubjectHeading();
        $form = $this->createForm(SubjectHeadingType::class, $subjectHeading);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($subjectHeading);
            $em->flush();

            $this->addFlash('success', 'The new subjectHeading was created.');
            return $this->redirectToRoute('subject_heading_show', array('id' => $subjectHeading->getId()));
        }

        return array(
            'subjectHeading' => $subjectHeading,
            'form' => $form->createView(),
        );
    }

    /**
     * Finds and displays a SubjectHeading entity.
     *
     * @Route("/{id}", name="subject_heading_show")
     * @Method("GET")
     * @Template()
     * @param SubjectHeading $subjectHeading
     */
    public function showAction(SubjectHeading $subjectHeading) {

        return array(
            'subjectHeading' => $subjectHeading,
        );
    }

    /**
     * Displays a form to edit an existing SubjectHeading entity.
     *
     * @Route("/{id}/edit", name="subject_heading_edit")
     * @Method({"GET", "POST"})
     * @Template()
     * @Security("has_role('ROLE_CONTENT_ADMIN')")
     * @param Request $request
     * @param SubjectHeading $subjectHeading
     */
    public function editAction(Request $request, SubjectHeading $subjectHeading) {
        $editForm = $this->createForm(SubjectHeadingType::class, $subjectHeading);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->flush();
            $this->addFlash('success', 'The subjectHeading has been updated.');
            return $this->redirectToRoute('subject_heading_show', array('id' => $subjectHeading->getId()));
        }

        return array(
            'subjectHeading' => $subjectHeading,
            'edit_form' => $editForm->createView(),
        );
    }

    /**
     * Deletes a SubjectHeading entity.
     *
     * @Route("/{id}/delete", name="subject_heading_delete")
     * @Method("GET")
     * @Security("has_role('ROLE_CONTENT_ADMIN')")
     * @param Request $request
     * @param SubjectHeading $subjectHeading
     */
    public function deleteAction(Request $request, SubjectHeading $subjectHeading) {
        $em = $this->getDoctrine()->getManager();
        $em->remove($subjectHeading);
        $em->flush();
        $this->addFlash('success', 'The subjectHeading was deleted.');

        return $this->redirectToRoute('subject_heading_index');
    }

}
