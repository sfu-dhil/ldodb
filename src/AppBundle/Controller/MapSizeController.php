<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use AppBundle\Entity\MapSize;
use AppBundle\Form\MapSizeType;

/**
 * MapSize controller.
 *
 * @Route("/map_size")
 */
class MapSizeController extends Controller {

    /**
     * Lists all MapSize entities.
     *
     * @param Request $request
     *
     * @return array
     *
     * @Route("/", name="map_size_index", methods={"GET"})")
     *
     * @Template()
     */
    public function indexAction(Request $request) {
        $em = $this->getDoctrine()->getManager();
        $qb = $em->createQueryBuilder();
        $qb->select('e')->from(MapSize::class, 'e')->orderBy('e.id', 'ASC');
        $query = $qb->getQuery();
        $paginator = $this->get('knp_paginator');
        $mapSizes = $paginator->paginate($query, $request->query->getint('page', 1), 25);

        return array(
            'mapSizes' => $mapSizes,
        );
    }

    /**
     * Typeahead API endpoint for MapSize entities.
     *
     * @param Request $request
     *
     * @Route("/typeahead", name="map_size_typeahead", methods={"GET"})")
     *
     * @return JsonResponse
     */
    public function typeahead(Request $request) {
        $q = $request->query->get('q');
        if (!$q) {
            return new JsonResponse([]);
        }
        $em = $this->getDoctrine()->getManager();
        $repo = $em->getRepository(MapSize::class);
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
     * Creates a new MapSize entity.
     *
     * @param Request $request
     *
     * @return array|RedirectResponse
     *
     * @Security("has_role('ROLE_CONTENT_ADMIN')")
     * @Route("/new", name="map_size_new", methods={"GET","POST"})")
     *
     * @Template()
     */
    public function newAction(Request $request) {
        $mapSize = new MapSize();
        $form = $this->createForm(MapSizeType::class, $mapSize);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($mapSize);
            $em->flush();

            $this->addFlash('success', 'The new mapSize was created.');
            return $this->redirectToRoute('map_size_show', array('id' => $mapSize->getId()));
        }

        return array(
            'mapSize' => $mapSize,
            'form' => $form->createView(),
        );
    }

    /**
     * Creates a new MapSize entity in a popup.
     *
     * @param Request $request
     *
     * @return array|RedirectResponse
     *
     * @Security("has_role('ROLE_CONTENT_ADMIN')")
     * @Route("/new_popup", name="map_size_new_popup", methods={"GET","POST"})")
     *
     * @Template()
     */
    public function newPopupAction(Request $request) {
        return $this->newAction($request);
    }

    /**
     * Finds and displays a MapSize entity.
     *
     * @param MapSize $mapSize
     *
     * @return array
     *
     * @Route("/{id}", name="map_size_show", methods={"GET"})")
     *
     * @Template()
     */
    public function showAction(MapSize $mapSize) {

        return array(
            'mapSize' => $mapSize,
        );
    }

    /**
     * Displays a form to edit an existing MapSize entity.
     *
     *
     * @param Request $request
     * @param MapSize $mapSize
     *
     * @return array|RedirectResponse
     *
     * @Security("has_role('ROLE_CONTENT_ADMIN')")
     * @Route("/{id}/edit", name="map_size_edit", methods={"GET","POST"})")
     *
     * @Template()
     */
    public function editAction(Request $request, MapSize $mapSize) {
        $editForm = $this->createForm(MapSizeType::class, $mapSize);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->flush();
            $this->addFlash('success', 'The mapSize has been updated.');
            return $this->redirectToRoute('map_size_show', array('id' => $mapSize->getId()));
        }

        return array(
            'mapSize' => $mapSize,
            'edit_form' => $editForm->createView(),
        );
    }

    /**
     * Deletes a MapSize entity.
     *
     *
     * @param Request $request
     * @param MapSize $mapSize
     *
     * @return array|RedirectResponse
     *
     * @Security("has_role('ROLE_CONTENT_ADMIN')")
     * @Route("/{id}/delete", name="map_size_delete", methods={"GET"})")
     *
     */
    public function deleteAction(Request $request, MapSize $mapSize) {
        $em = $this->getDoctrine()->getManager();
        $em->remove($mapSize);
        $em->flush();
        $this->addFlash('success', 'The mapSize was deleted.');

        return $this->redirectToRoute('map_size_index');
    }

}
