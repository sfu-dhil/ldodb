<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use AppBundle\Entity\SupplementalPlaceData;
use AppBundle\Form\SupplementalPlaceDataType;

/**
 * SupplementalPlaceData controller.
 *
 * @Route("/supplemental_place_data")
 */
class SupplementalPlaceDataController extends Controller {

    /**
     * Lists all SupplementalPlaceData entities.
     *
     * @param Request $request
     *
     * @return array
     *
     * @Route("/", name="supplemental_place_data_index", methods={"GET"})")
     *
     * @Template()
     */
    public function indexAction(Request $request) {
        $em = $this->getDoctrine()->getManager();
        $qb = $em->createQueryBuilder();
        $qb->select('e')->from(SupplementalPlaceData::class, 'e')->orderBy('e.id', 'ASC');
        $query = $qb->getQuery();
        $paginator = $this->get('knp_paginator');
        $supplementalPlaceDatas = $paginator->paginate($query, $request->query->getint('page', 1), 25);

        return array(
            'supplementalPlaceDatas' => $supplementalPlaceDatas,
        );
    }

    /**
     * Typeahead API endpoint for SupplementalPlaceData entities.
     *
     * @param Request $request
     *
     * @Route("/typeahead", name="supplemental_place_data_typeahead", methods={"GET"})")
     *
     * @return JsonResponse
     */
    public function typeahead(Request $request) {
        $q = $request->query->get('q');
        if (!$q) {
            return new JsonResponse([]);
        }
        $em = $this->getDoctrine()->getManager();
        $repo = $em->getRepository(SupplementalPlaceData::class);
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
     * Creates a new SupplementalPlaceData entity.
     *
     * @param Request $request
     *
     * @return array|RedirectResponse
     *
     * @Security("has_role('ROLE_CONTENT_ADMIN')")
     * @Route("/new", name="supplemental_place_data_new", methods={"GET","POST"})")
     *
     * @Template()
     */
    public function newAction(Request $request) {
        $supplementalPlaceDatum = new SupplementalPlaceData();
        $form = $this->createForm(SupplementalPlaceDataType::class, $supplementalPlaceDatum);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($supplementalPlaceDatum);
            $em->flush();

            $this->addFlash('success', 'The new supplementalPlaceDatum was created.');
            return $this->redirectToRoute('supplemental_place_data_show', array('id' => $supplementalPlaceDatum->getId()));
        }

        return array(
            'supplementalPlaceDatum' => $supplementalPlaceDatum,
            'form' => $form->createView(),
        );
    }

    /**
     * Creates a new SupplementalPlaceData entity in a popup.
     *
     * @param Request $request
     *
     * @return array|RedirectResponse
     *
     * @Security("has_role('ROLE_CONTENT_ADMIN')")
     * @Route("/new_popup", name="supplemental_place_data_new_popup", methods={"GET","POST"})")
     *
     * @Template()
     */
    public function newPopupAction(Request $request) {
        return $this->newAction($request);
    }

    /**
     * Finds and displays a SupplementalPlaceData entity.
     *
     * @param SupplementalPlaceData $supplementalPlaceDatum
     *
     * @return array
     *
     * @Route("/{id}", name="supplemental_place_data_show", methods={"GET"})")
     *
     * @Template()
     */
    public function showAction(SupplementalPlaceData $supplementalPlaceDatum) {

        return array(
            'supplementalPlaceDatum' => $supplementalPlaceDatum,
        );
    }

    /**
     * Displays a form to edit an existing SupplementalPlaceData entity.
     *
     *
     * @param Request $request
     * @param SupplementalPlaceData $supplementalPlaceDatum
     *
     * @return array|RedirectResponse
     *
     * @Security("has_role('ROLE_CONTENT_ADMIN')")
     * @Route("/{id}/edit", name="supplemental_place_data_edit", methods={"GET","POST"})")
     *
     * @Template()
     */
    public function editAction(Request $request, SupplementalPlaceData $supplementalPlaceDatum) {
        $editForm = $this->createForm(SupplementalPlaceDataType::class, $supplementalPlaceDatum);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->flush();
            $this->addFlash('success', 'The supplementalPlaceDatum has been updated.');
            return $this->redirectToRoute('supplemental_place_data_show', array('id' => $supplementalPlaceDatum->getId()));
        }

        return array(
            'supplementalPlaceDatum' => $supplementalPlaceDatum,
            'edit_form' => $editForm->createView(),
        );
    }

    /**
     * Deletes a SupplementalPlaceData entity.
     *
     *
     * @param Request $request
     * @param SupplementalPlaceData $supplementalPlaceDatum
     *
     * @return array|RedirectResponse
     *
     * @Security("has_role('ROLE_CONTENT_ADMIN')")
     * @Route("/{id}/delete", name="supplemental_place_data_delete", methods={"GET"})")
     *
     */
    public function deleteAction(Request $request, SupplementalPlaceData $supplementalPlaceDatum) {
        $em = $this->getDoctrine()->getManager();
        $em->remove($supplementalPlaceDatum);
        $em->flush();
        $this->addFlash('success', 'The supplementalPlaceDatum was deleted.');

        return $this->redirectToRoute('supplemental_place_data_index');
    }

}
