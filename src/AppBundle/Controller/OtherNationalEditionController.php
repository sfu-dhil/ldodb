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
use AppBundle\Entity\OtherNationalEdition;
use AppBundle\Form\OtherNationalEditionType;

/**
 * OtherNationalEdition controller.
 *
 * @Route("/other_national_edition")
 */
class OtherNationalEditionController extends Controller {

    /**
     * Lists all OtherNationalEdition entities.
     *
     * @param Request $request
     *
     * @return array
     *
     * @Route("/", name="other_national_edition_index")
     * @Method("GET")
     * @Template()
     */
    public function indexAction(Request $request) {
        $em = $this->getDoctrine()->getManager();
        $qb = $em->createQueryBuilder();
        $qb->select('e')->from(OtherNationalEdition::class, 'e')->orderBy('e.id', 'ASC');
        $query = $qb->getQuery();
        $paginator = $this->get('knp_paginator');
        $otherNationalEditions = $paginator->paginate($query, $request->query->getint('page', 1), 25);

        return array(
            'otherNationalEditions' => $otherNationalEditions,
        );
    }

    /**
     * Creates a new OtherNationalEdition entity.
     *
     * @param Request $request
     *
     * @return array|RedirectResponse
     *
     * @Security("has_role('ROLE_CONTENT_ADMIN')")
     * @Route("/new", name="other_national_edition_new")
     * @Method({"GET", "POST"})
     * @Template()
     */
    public function newAction(Request $request) {
        $otherNationalEdition = new OtherNationalEdition();
        $form = $this->createForm(OtherNationalEditionType::class, $otherNationalEdition);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($otherNationalEdition);
            $em->flush();

            $this->addFlash('success', 'The new otherNationalEdition was created.');
            return $this->redirectToRoute('other_national_edition_show', array('id' => $otherNationalEdition->getId()));
        }

        return array(
            'otherNationalEdition' => $otherNationalEdition,
            'form' => $form->createView(),
        );
    }

    /**
     * Creates a new OtherNationalEdition entity in a popup.
     *
     * @param Request $request
     *
     * @return array|RedirectResponse
     *
     * @Security("has_role('ROLE_CONTENT_ADMIN')")
     * @Route("/new_popup", name="other_national_edition_new_popup")
     * @Method({"GET", "POST"})
     * @Template()
     */
    public function newPopupAction(Request $request) {
        return $this->newAction($request);
    }

    /**
     * Finds and displays a OtherNationalEdition entity.
     *
     * @param OtherNationalEdition $otherNationalEdition
     *
     * @return array
     *
     * @Route("/{id}", name="other_national_edition_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction(OtherNationalEdition $otherNationalEdition) {

        return array(
            'otherNationalEdition' => $otherNationalEdition,
        );
    }

    /**
     * Displays a form to edit an existing OtherNationalEdition entity.
     *
     *
     * @param Request $request
     * @param OtherNationalEdition $otherNationalEdition
     *
     * @return array|RedirectResponse
     *
     * @Security("has_role('ROLE_CONTENT_ADMIN')")
     * @Route("/{id}/edit", name="other_national_edition_edit")
     * @Method({"GET", "POST"})
     * @Template()
     */
    public function editAction(Request $request, OtherNationalEdition $otherNationalEdition) {
        $editForm = $this->createForm(OtherNationalEditionType::class, $otherNationalEdition);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->flush();
            $this->addFlash('success', 'The otherNationalEdition has been updated.');
            return $this->redirectToRoute('other_national_edition_show', array('id' => $otherNationalEdition->getId()));
        }

        return array(
            'otherNationalEdition' => $otherNationalEdition,
            'edit_form' => $editForm->createView(),
        );
    }

    /**
     * Deletes a OtherNationalEdition entity.
     *
     *
     * @param Request $request
     * @param OtherNationalEdition $otherNationalEdition
     *
     * @return array|RedirectResponse
     *
     * @Security("has_role('ROLE_CONTENT_ADMIN')")
     * @Route("/{id}/delete", name="other_national_edition_delete")
     * @Method("GET")
     */
    public function deleteAction(Request $request, OtherNationalEdition $otherNationalEdition) {
        $em = $this->getDoctrine()->getManager();
        $em->remove($otherNationalEdition);
        $em->flush();
        $this->addFlash('success', 'The otherNationalEdition was deleted.');

        return $this->redirectToRoute('other_national_edition_index');
    }

}
