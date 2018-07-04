<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\JsonResponse;
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
     * @param Request $request
     *
     * @return array
     *
     * @Route("/", name="referenced_person_index")
     * @Method("GET")
     * @Template()
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
     * Typeahead API endpoint for ReferencedPerson entities.
     *
     * @param Request $request
     *
     * @Route("/typeahead", name="referenced_person_typeahead")
     * @Method("GET")
     * @return JsonResponse
     */
    public function typeahead(Request $request) {
        $q = $request->query->get('q');
        if (!$q) {
            return new JsonResponse([]);
        }
        $em = $this->getDoctrine()->getManager();
        $repo = $em->getRepository(ReferencedPerson::class);
        $data = [];
        foreach ($repo->typeaheadQuery($q) as $result) {
            $data[] = [
                'id' => $result->getId(),
                'text' => (string) $result,
            ];
        }
        return new JsonResponse($data);
    }

    /**
     * Search for ReferencedPerson entities.
     *
     * @param Request $request
     *
     * @Route("/search", name="referenced_person_search")
     * @Method("GET")
     * @Template()
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
     * Creates a new ReferencedPerson entity.
     *
     * @param Request $request
     *
     * @return array|RedirectResponse
     *
     * @Security("has_role('ROLE_CONTENT_ADMIN')")
     * @Route("/new", name="referenced_person_new")
     * @Method({"GET", "POST"})
     * @Template()
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
     * Creates a new ReferencedPerson entity in a popup.
     *
     * @param Request $request
     *
     * @return array|RedirectResponse
     *
     * @Security("has_role('ROLE_CONTENT_ADMIN')")
     * @Route("/new_popup", name="referenced_person_new_popup")
     * @Method({"GET", "POST"})
     * @Template()
     */
    public function newPopupAction(Request $request) {
        return $this->newAction($request);
    }

    /**
     * Finds and displays a ReferencedPerson entity.
     *
     * @param ReferencedPerson $referencedPerson
     *
     * @return array
     *
     * @Route("/{id}", name="referenced_person_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction(ReferencedPerson $referencedPerson) {

        return array(
            'referencedPerson' => $referencedPerson,
        );
    }

    /**
     * Displays a form to edit an existing ReferencedPerson entity.
     *
     *
     * @param Request $request
     * @param ReferencedPerson $referencedPerson
     *
     * @return array|RedirectResponse
     *
     * @Security("has_role('ROLE_CONTENT_ADMIN')")
     * @Route("/{id}/edit", name="referenced_person_edit")
     * @Method({"GET", "POST"})
     * @Template()
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
     *
     * @param Request $request
     * @param ReferencedPerson $referencedPerson
     *
     * @return array|RedirectResponse
     *
     * @Security("has_role('ROLE_CONTENT_ADMIN')")
     * @Route("/{id}/delete", name="referenced_person_delete")
     * @Method("GET")
     */
    public function deleteAction(Request $request, ReferencedPerson $referencedPerson) {
        $em = $this->getDoctrine()->getManager();
        $em->remove($referencedPerson);
        $em->flush();
        $this->addFlash('success', 'The referencedPerson was deleted.');

        return $this->redirectToRoute('referenced_person_index');
    }

}
