<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
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
     * @Route("/", name="map_size_index")
     * @Method("GET")
     * @Template()
     * @param Request $request
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
     * Creates a new MapSize entity.
     *
     * @Route("/new", name="map_size_new")
     * @Method({"GET", "POST"})
     * @Security("has_role('ROLE_CONTENT_ADMIN')")
     * @Template()
     * @param Request $request
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
     * Finds and displays a MapSize entity.
     *
     * @Route("/{id}", name="map_size_show")
     * @Method("GET")
     * @Template()
     * @param MapSize $mapSize
     */
    public function showAction(MapSize $mapSize) {

        return array(
            'mapSize' => $mapSize,
        );
    }

    /**
     * Displays a form to edit an existing MapSize entity.
     *
     * @Route("/{id}/edit", name="map_size_edit")
     * @Method({"GET", "POST"})
     * @Template()
     * @Security("has_role('ROLE_CONTENT_ADMIN')")
     * @param Request $request
     * @param MapSize $mapSize
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
     * @Route("/{id}/delete", name="map_size_delete")
     * @Method("GET")
     * @Security("has_role('ROLE_CONTENT_ADMIN')")
     * @param Request $request
     * @param MapSize $mapSize
     */
    public function deleteAction(Request $request, MapSize $mapSize) {
        $em = $this->getDoctrine()->getManager();
        $em->remove($mapSize);
        $em->flush();
        $this->addFlash('success', 'The mapSize was deleted.');

        return $this->redirectToRoute('map_size_index');
    }

}
