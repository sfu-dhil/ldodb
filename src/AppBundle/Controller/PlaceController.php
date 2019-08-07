<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use AppBundle\Entity\Place;
use AppBundle\Form\PlaceType;

/**
 * Place controller.
 *
 * @Route("/place")
 */
class PlaceController extends Controller {

    /**
     * Lists all Place entities.
     *
     * @param Request $request
     *
     * @return array
     *
     * @Route("/", name="place_index", methods={"GET"})")
     *
     * @Template()
     */
    public function indexAction(Request $request) {
        $em = $this->getDoctrine()->getManager();
        $qb = $em->createQueryBuilder();
        $qb->select('e')->from(Place::class, 'e')->orderBy('e.placeName', 'ASC');
        $query = $qb->getQuery();
        $paginator = $this->get('knp_paginator');
        $places = $paginator->paginate($query, $request->query->getint('page', 1), 25);

        return array(
            'places' => $places,
        );
    }

    /**
     * Typeahead API endpoint for Place entities.
     *
     * @param Request $request
     *
     * @Route("/typeahead", name="place_typeahead", methods={"GET"})")
     *
     * @return JsonResponse
     */
    public function typeahead(Request $request) {
        $q = $request->query->get('q');
        if (!$q) {
            return new JsonResponse([]);
        }
        $em = $this->getDoctrine()->getManager();
        $repo = $em->getRepository(Place::class);
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
     * Search for Place entities.
     *
     * @param Request $request
     *
     * @Route("/search", name="place_search", methods={"GET"})")
     *
     * @Template()
     */
    public function searchAction(Request $request) {
        $em = $this->getDoctrine()->getManager();
        $repo = $em->getRepository('AppBundle:Place');
        $q = $request->query->get('q');
        if ($q) {
            $query = $repo->searchQuery($q);
            $paginator = $this->get('knp_paginator');
            $places = $paginator->paginate($query, $request->query->getInt('page', 1), 25);
        } else {
            $places = array();
        }

        return array(
            'places' => $places,
            'q' => $q,
        );
    }

    /**
     * Creates a new Place entity.
     *
     * @param Request $request
     *
     * @return array|RedirectResponse
     *
     * @Security("has_role('ROLE_CONTENT_ADMIN')")
     * @Route("/new", name="place_new", methods={"GET","POST"})")
     *
     * @Template()
     */
    public function newAction(Request $request) {
        $place = new Place();
        $form = $this->createForm(PlaceType::class, $place);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($place);
            $em->flush();

            $this->addFlash('success', 'The new place was created.');
            return $this->redirectToRoute('place_show', array('id' => $place->getId()));
        }

        return array(
            'place' => $place,
            'form' => $form->createView(),
        );
    }

    /**
     * Creates a new Place entity in a popup.
     *
     * @param Request $request
     *
     * @return array|RedirectResponse
     *
     * @Security("has_role('ROLE_CONTENT_ADMIN')")
     * @Route("/new_popup", name="place_new_popup", methods={"GET","POST"})")
     *
     * @Template()
     */
    public function newPopupAction(Request $request) {
        return $this->newAction($request);
    }

    /**
     * Finds and displays a Place entity.
     *
     * @param Place $place
     *
     * @return array
     *
     * @Route("/{id}", name="place_show", methods={"GET"})")
     *
     * @Template()
     */
    public function showAction(Place $place) {

        return array(
            'place' => $place,
        );
    }

    /**
     * Displays a form to edit an existing Place entity.
     *
     *
     * @param Request $request
     * @param Place $place
     *
     * @return array|RedirectResponse
     *
     * @Security("has_role('ROLE_CONTENT_ADMIN')")
     * @Route("/{id}/edit", name="place_edit", methods={"GET","POST"})")
     *
     * @Template()
     */
    public function editAction(Request $request, Place $place) {
        $editForm = $this->createForm(PlaceType::class, $place);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->flush();
            $this->addFlash('success', 'The place has been updated.');
            return $this->redirectToRoute('place_show', array('id' => $place->getId()));
        }

        return array(
            'place' => $place,
            'edit_form' => $editForm->createView(),
        );
    }

    /**
     * Deletes a Place entity.
     *
     *
     * @param Request $request
     * @param Place $place
     *
     * @return array|RedirectResponse
     *
     * @Security("has_role('ROLE_CONTENT_ADMIN')")
     * @Route("/{id}/delete", name="place_delete", methods={"GET"})")
     *
     */
    public function deleteAction(Request $request, Place $place) {
        $em = $this->getDoctrine()->getManager();
        $em->remove($place);
        $em->flush();
        $this->addFlash('success', 'The place was deleted.');

        return $this->redirectToRoute('place_index');
    }

}
