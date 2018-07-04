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
use AppBundle\Entity\MapType;
use AppBundle\Form\MapTypeType;

/**
 * MapType controller.
 *
 * @Route("/map_type")
 */
class MapTypeController extends Controller {

    /**
     * Lists all MapType entities.
     *
     * @param Request $request
     *
     * @return array
     *
     * @Route("/", name="map_type_index")
     * @Method("GET")
     * @Template()
     */
    public function indexAction(Request $request) {
        $em = $this->getDoctrine()->getManager();
        $qb = $em->createQueryBuilder();
        $qb->select('e')->from(MapType::class, 'e')->orderBy('e.id', 'ASC');
        $query = $qb->getQuery();
        $paginator = $this->get('knp_paginator');
        $mapTypes = $paginator->paginate($query, $request->query->getint('page', 1), 25);

        return array(
            'mapTypes' => $mapTypes,
        );
    }

    /**
     * Typeahead API endpoint for MapType entities.
     *
     * @param Request $request
     *
     * @Route("/typeahead", name="map_type_typeahead")
     * @Method("GET")
     * @return JsonResponse
     */
    public function typeahead(Request $request) {
        $q = $request->query->get('q');
        if (!$q) {
            return new JsonResponse([]);
        }
        $em = $this->getDoctrine()->getManager();
        $repo = $em->getRepository(MapType::class);
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
     * Creates a new MapType entity.
     *
     * @param Request $request
     *
     * @return array|RedirectResponse
     *
     * @Security("has_role('ROLE_CONTENT_ADMIN')")
     * @Route("/new", name="map_type_new")
     * @Method({"GET", "POST"})
     * @Template()
     */
    public function newAction(Request $request) {
        $mapType = new MapType();
        $form = $this->createForm(MapTypeType::class, $mapType);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($mapType);
            $em->flush();

            $this->addFlash('success', 'The new mapType was created.');
            return $this->redirectToRoute('map_type_show', array('id' => $mapType->getId()));
        }

        return array(
            'mapType' => $mapType,
            'form' => $form->createView(),
        );
    }

    /**
     * Creates a new MapType entity in a popup.
     *
     * @param Request $request
     *
     * @return array|RedirectResponse
     *
     * @Security("has_role('ROLE_CONTENT_ADMIN')")
     * @Route("/new_popup", name="map_type_new_popup")
     * @Method({"GET", "POST"})
     * @Template()
     */
    public function newPopupAction(Request $request) {
        return $this->newAction($request);
    }

    /**
     * Finds and displays a MapType entity.
     *
     * @param MapType $mapType
     *
     * @return array
     *
     * @Route("/{id}", name="map_type_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction(MapType $mapType) {

        return array(
            'mapType' => $mapType,
        );
    }

    /**
     * Displays a form to edit an existing MapType entity.
     *
     *
     * @param Request $request
     * @param MapType $mapType
     *
     * @return array|RedirectResponse
     *
     * @Security("has_role('ROLE_CONTENT_ADMIN')")
     * @Route("/{id}/edit", name="map_type_edit")
     * @Method({"GET", "POST"})
     * @Template()
     */
    public function editAction(Request $request, MapType $mapType) {
        $editForm = $this->createForm(MapTypeType::class, $mapType);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->flush();
            $this->addFlash('success', 'The mapType has been updated.');
            return $this->redirectToRoute('map_type_show', array('id' => $mapType->getId()));
        }

        return array(
            'mapType' => $mapType,
            'edit_form' => $editForm->createView(),
        );
    }

    /**
     * Deletes a MapType entity.
     *
     *
     * @param Request $request
     * @param MapType $mapType
     *
     * @return array|RedirectResponse
     *
     * @Security("has_role('ROLE_CONTENT_ADMIN')")
     * @Route("/{id}/delete", name="map_type_delete")
     * @Method("GET")
     */
    public function deleteAction(Request $request, MapType $mapType) {
        $em = $this->getDoctrine()->getManager();
        $em->remove($mapType);
        $em->flush();
        $this->addFlash('success', 'The mapType was deleted.');

        return $this->redirectToRoute('map_type_index');
    }

}
