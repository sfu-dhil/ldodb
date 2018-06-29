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
use AppBundle\Entity\ReferencedPlace;
use AppBundle\Form\ReferencedPlaceType;

/**
 * ReferencedPlace controller.
 *
 * @Security("has_role('ROLE_USER')")
 * @Route("/referenced_place")
 */
class ReferencedPlaceController extends Controller {

    /**
     * Lists all ReferencedPlace entities.
     *
     * @param Request $request
     *
     * @return array
     *
     * @Route("/", name="referenced_place_index")
     * @Method("GET")
     * @Template()
     */
    public function indexAction(Request $request) {
        $em = $this->getDoctrine()->getManager();
        $qb = $em->createQueryBuilder();
        $qb->select('e')->from(ReferencedPlace::class, 'e')->orderBy('e.id', 'ASC');
        $query = $qb->getQuery();
        $paginator = $this->get('knp_paginator');
        $referencedPlaces = $paginator->paginate($query, $request->query->getint('page', 1), 25);

        return array(
            'referencedPlaces' => $referencedPlaces,
        );
    }

    /**
     * Typeahead API endpoint for ReferencedPlace entities.
     *
     * @param Request $request
     *
     * @Route("/typeahead", name="referenced_place_typeahead")
     * @Method("GET")
     * @return JsonResponse
     */
    public function typeahead(Request $request) {
        $q = $request->query->get('q');
        if (!$q) {
            return new JsonResponse([]);
        }
        $em = $this->getDoctrine()->getManager();
        $repo = $em->getRepository(ReferencedPlace::class);
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
     * Creates a new ReferencedPlace entity.
     *
     * @param Request $request
     *
     * @return array|RedirectResponse
     *
     * @Security("has_role('ROLE_CONTENT_ADMIN')")
     * @Route("/new", name="referenced_place_new")
     * @Method({"GET", "POST"})
     * @Template()
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
     * Creates a new ReferencedPlace entity in a popup.
     *
     * @param Request $request
     *
     * @return array|RedirectResponse
     *
     * @Security("has_role('ROLE_CONTENT_ADMIN')")
     * @Route("/new_popup", name="referenced_place_new_popup")
     * @Method({"GET", "POST"})
     * @Template()
     */
    public function newPopupAction(Request $request) {
        return $this->newAction($request);
    }

    /**
     * Finds and displays a ReferencedPlace entity.
     *
     * @param ReferencedPlace $referencedPlace
     *
     * @return array
     *
     * @Route("/{id}", name="referenced_place_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction(ReferencedPlace $referencedPlace) {

        return array(
            'referencedPlace' => $referencedPlace,
        );
    }

    /**
     * Displays a form to edit an existing ReferencedPlace entity.
     *
     *
     * @param Request $request
     * @param ReferencedPlace $referencedPlace
     *
     * @return array|RedirectResponse
     *
     * @Security("has_role('ROLE_CONTENT_ADMIN')")
     * @Route("/{id}/edit", name="referenced_place_edit")
     * @Method({"GET", "POST"})
     * @Template()
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
     *
     * @param Request $request
     * @param ReferencedPlace $referencedPlace
     *
     * @return array|RedirectResponse
     *
     * @Security("has_role('ROLE_CONTENT_ADMIN')")
     * @Route("/{id}/delete", name="referenced_place_delete")
     * @Method("GET")
     */
    public function deleteAction(Request $request, ReferencedPlace $referencedPlace) {
        $em = $this->getDoctrine()->getManager();
        $em->remove($referencedPlace);
        $em->flush();
        $this->addFlash('success', 'The referencedPlace was deleted.');

        return $this->redirectToRoute('referenced_place_index');
    }

}
