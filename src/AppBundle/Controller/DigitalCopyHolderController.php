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
use AppBundle\Entity\DigitalCopyHolder;
use AppBundle\Form\DigitalCopyHolderType;

/**
 * DigitalCopyHolder controller.
 *
 * @Route("/digital_copy_holder")
 */
class DigitalCopyHolderController extends Controller {

    /**
     * Lists all DigitalCopyHolder entities.
     *
     * @param Request $request
     *
     * @return array
     *
     * @Route("/", name="digital_copy_holder_index")
     * @Method("GET")
     * @Template()
     */
    public function indexAction(Request $request) {
        $em = $this->getDoctrine()->getManager();
        $qb = $em->createQueryBuilder();
        $qb->select('e')->from(DigitalCopyHolder::class, 'e')->orderBy('e.id', 'ASC');
        $query = $qb->getQuery();
        $paginator = $this->get('knp_paginator');
        $digitalCopyHolders = $paginator->paginate($query, $request->query->getint('page', 1), 25);

        return array(
            'digitalCopyHolders' => $digitalCopyHolders,
        );
    }

    /**
     * Typeahead API endpoint for DigitalCopyHolder entities.
     *
     * @param Request $request
     *
     * @Route("/typeahead", name="digital_copy_holder_typeahead")
     * @Method("GET")
     * @return JsonResponse
     */
    public function typeahead(Request $request) {
        $q = $request->query->get('q');
        if (!$q) {
            return new JsonResponse([]);
        }
        $em = $this->getDoctrine()->getManager();
        $repo = $em->getRepository(DigitalCopyHolder::class);
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
     * Creates a new DigitalCopyHolder entity.
     *
     * @param Request $request
     *
     * @return array|RedirectResponse
     *
     * @Security("has_role('ROLE_CONTENT_ADMIN')")
     * @Route("/new", name="digital_copy_holder_new")
     * @Method({"GET", "POST"})
     * @Template()
     */
    public function newAction(Request $request) {
        $digitalCopyHolder = new DigitalCopyHolder();
        $form = $this->createForm(DigitalCopyHolderType::class, $digitalCopyHolder);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($digitalCopyHolder);
            $em->flush();

            $this->addFlash('success', 'The new digitalCopyHolder was created.');
            return $this->redirectToRoute('digital_copy_holder_show', array('id' => $digitalCopyHolder->getId()));
        }

        return array(
            'digitalCopyHolder' => $digitalCopyHolder,
            'form' => $form->createView(),
        );
    }

    /**
     * Creates a new DigitalCopyHolder entity in a popup.
     *
     * @param Request $request
     *
     * @return array|RedirectResponse
     *
     * @Security("has_role('ROLE_CONTENT_ADMIN')")
     * @Route("/new_popup", name="digital_copy_holder_new_popup")
     * @Method({"GET", "POST"})
     * @Template()
     */
    public function newPopupAction(Request $request) {
        return $this->newAction($request);
    }

    /**
     * Finds and displays a DigitalCopyHolder entity.
     *
     * @param DigitalCopyHolder $digitalCopyHolder
     *
     * @return array
     *
     * @Route("/{id}", name="digital_copy_holder_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction(DigitalCopyHolder $digitalCopyHolder) {

        return array(
            'digitalCopyHolder' => $digitalCopyHolder,
        );
    }

    /**
     * Displays a form to edit an existing DigitalCopyHolder entity.
     *
     *
     * @param Request $request
     * @param DigitalCopyHolder $digitalCopyHolder
     *
     * @return array|RedirectResponse
     *
     * @Security("has_role('ROLE_CONTENT_ADMIN')")
     * @Route("/{id}/edit", name="digital_copy_holder_edit")
     * @Method({"GET", "POST"})
     * @Template()
     */
    public function editAction(Request $request, DigitalCopyHolder $digitalCopyHolder) {
        $editForm = $this->createForm(DigitalCopyHolderType::class, $digitalCopyHolder);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->flush();
            $this->addFlash('success', 'The digitalCopyHolder has been updated.');
            return $this->redirectToRoute('digital_copy_holder_show', array('id' => $digitalCopyHolder->getId()));
        }

        return array(
            'digitalCopyHolder' => $digitalCopyHolder,
            'edit_form' => $editForm->createView(),
        );
    }

    /**
     * Deletes a DigitalCopyHolder entity.
     *
     *
     * @param Request $request
     * @param DigitalCopyHolder $digitalCopyHolder
     *
     * @return array|RedirectResponse
     *
     * @Security("has_role('ROLE_CONTENT_ADMIN')")
     * @Route("/{id}/delete", name="digital_copy_holder_delete")
     * @Method("GET")
     */
    public function deleteAction(Request $request, DigitalCopyHolder $digitalCopyHolder) {
        $em = $this->getDoctrine()->getManager();
        $em->remove($digitalCopyHolder);
        $em->flush();
        $this->addFlash('success', 'The digitalCopyHolder was deleted.');

        return $this->redirectToRoute('digital_copy_holder_index');
    }

}
