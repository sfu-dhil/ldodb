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
use AppBundle\Entity\Contribution;
use AppBundle\Form\ContributionType;

/**
 * Contribution controller.
 *
 * @Route("/contribution")
 */
class ContributionController extends Controller {

    /**
     * Lists all Contribution entities.
     *
     * @param Request $request
     *
     * @return array
     *
     * @Route("/", name="contribution_index")
     * @Method("GET")
     * @Template()
     */
    public function indexAction(Request $request) {
        $em = $this->getDoctrine()->getManager();
        $qb = $em->createQueryBuilder();
        $qb->select('e')->from(Contribution::class, 'e')->orderBy('e.id', 'ASC');
        $query = $qb->getQuery();
        $paginator = $this->get('knp_paginator');
        $contributions = $paginator->paginate($query, $request->query->getint('page', 1), 25);

        return array(
            'contributions' => $contributions,
        );
    }

    /**
     * Creates a new Contribution entity.
     *
     * @param Request $request
     *
     * @return array|RedirectResponse
     *
     * @Security("has_role('ROLE_CONTENT_ADMIN')")
     * @Route("/new", name="contribution_new")
     * @Method({"GET", "POST"})
     * @Template()
     */
    public function newAction(Request $request) {
        $contribution = new Contribution();
        $form = $this->createForm(ContributionType::class, $contribution);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($contribution);
            $em->flush();

            $this->addFlash('success', 'The new contribution was created.');
            return $this->redirectToRoute('contribution_show', array('id' => $contribution->getId()));
        }

        return array(
            'contribution' => $contribution,
            'form' => $form->createView(),
        );
    }

    /**
     * Creates a new Contribution entity in a popup.
     *
     * @param Request $request
     *
     * @return array|RedirectResponse
     *
     * @Security("has_role('ROLE_CONTENT_ADMIN')")
     * @Route("/new_popup", name="contribution_new_popup")
     * @Method({"GET", "POST"})
     * @Template()
     */
    public function newPopupAction(Request $request) {
        return $this->newAction($request);
    }

    /**
     * Finds and displays a Contribution entity.
     *
     * @param Contribution $contribution
     *
     * @return array
     *
     * @Route("/{id}", name="contribution_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction(Contribution $contribution) {

        return array(
            'contribution' => $contribution,
        );
    }

    /**
     * Displays a form to edit an existing Contribution entity.
     *
     *
     * @param Request $request
     * @param Contribution $contribution
     *
     * @return array|RedirectResponse
     *
     * @Security("has_role('ROLE_CONTENT_ADMIN')")
     * @Route("/{id}/edit", name="contribution_edit")
     * @Method({"GET", "POST"})
     * @Template()
     */
    public function editAction(Request $request, Contribution $contribution) {
        $editForm = $this->createForm(ContributionType::class, $contribution);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->flush();
            $this->addFlash('success', 'The contribution has been updated.');
            return $this->redirectToRoute('contribution_show', array('id' => $contribution->getId()));
        }

        return array(
            'contribution' => $contribution,
            'edit_form' => $editForm->createView(),
        );
    }

    /**
     * Deletes a Contribution entity.
     *
     *
     * @param Request $request
     * @param Contribution $contribution
     *
     * @return array|RedirectResponse
     *
     * @Security("has_role('ROLE_CONTENT_ADMIN')")
     * @Route("/{id}/delete", name="contribution_delete")
     * @Method("GET")
     */
    public function deleteAction(Request $request, Contribution $contribution) {
        $em = $this->getDoctrine()->getManager();
        $em->remove($contribution);
        $em->flush();
        $this->addFlash('success', 'The contribution was deleted.');

        return $this->redirectToRoute('contribution_index');
    }

}
