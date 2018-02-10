<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
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
     * @Route("/", name="map_type_index")
     * @Method("GET")
     * @Template()
     * @param Request $request
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
     * Creates a new MapType entity.
     *
     * @Route("/new", name="map_type_new")
     * @Method({"GET", "POST"})
     * @Security("has_role('ROLE_CONTENT_ADMIN')")
     * @Template()
     * @param Request $request
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
     * Finds and displays a MapType entity.
     *
     * @Route("/{id}", name="map_type_show")
     * @Method("GET")
     * @Template()
     * @param MapType $mapType
     */
    public function showAction(MapType $mapType) {

        return array(
            'mapType' => $mapType,
        );
    }

    /**
     * Displays a form to edit an existing MapType entity.
     *
     * @Route("/{id}/edit", name="map_type_edit")
     * @Method({"GET", "POST"})
     * @Template()
     * @Security("has_role('ROLE_CONTENT_ADMIN')")
     * @param Request $request
     * @param MapType $mapType
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
     * @Route("/{id}/delete", name="map_type_delete")
     * @Method("GET")
     * @Security("has_role('ROLE_CONTENT_ADMIN')")
     * @param Request $request
     * @param MapType $mapType
     */
    public function deleteAction(Request $request, MapType $mapType) {
        if (!$this->isGranted('ROLE_CONTENT_ADMIN')) {
            $this->addFlash('danger', 'You must login to access this page.');
            return $this->redirect($this->generateUrl('fos_user_security_login'));
        }
        $em = $this->getDoctrine()->getManager();
        $em->remove($mapType);
        $em->flush();
        $this->addFlash('success', 'The mapType was deleted.');

        return $this->redirectToRoute('map_type_index');
    }

}
