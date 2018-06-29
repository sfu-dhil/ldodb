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
use AppBundle\Entity\BibliographicTerms;
use AppBundle\Form\BibliographicTermsType;

/**
 * BibliographicTerms controller.
 *
 * @Security("has_role('ROLE_USER')")
 * @Route("/bibliographic_terms")
 */
class BibliographicTermsController extends Controller {

    /**
     * Lists all BibliographicTerms entities.
     *
     * @param Request $request
     *
     * @return array
     *
     * @Route("/", name="bibliographic_terms_index")
     * @Method("GET")
     * @Template()
     */
    public function indexAction(Request $request) {
        $em = $this->getDoctrine()->getManager();
        $qb = $em->createQueryBuilder();
        $qb->select('e')->from(BibliographicTerms::class, 'e')->orderBy('e.id', 'ASC');
        $query = $qb->getQuery();
        $paginator = $this->get('knp_paginator');
        $bibliographicTerms = $paginator->paginate($query, $request->query->getint('page', 1), 25);

        return array(
            'bibliographicTerms' => $bibliographicTerms,
        );
    }

    /**
     * Typeahead API endpoint for BibliographicTerms entities.
     *
     * @param Request $request
     *
     * @Route("/typeahead", name="bibliographic_terms_typeahead")
     * @Method("GET")
     * @return JsonResponse
     */
    public function typeahead(Request $request) {
        $q = $request->query->get('q');
        if (!$q) {
            return new JsonResponse([]);
        }
        $em = $this->getDoctrine()->getManager();
        $repo = $em->getRepository(BibliographicTerms::class);
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
     * Creates a new BibliographicTerms entity.
     *
     * @param Request $request
     *
     * @return array|RedirectResponse
     *
     * @Security("has_role('ROLE_CONTENT_ADMIN')")
     * @Route("/new", name="bibliographic_terms_new")
     * @Method({"GET", "POST"})
     * @Template()
     */
    public function newAction(Request $request) {
        $bibliographicTerm = new BibliographicTerms();
        $form = $this->createForm(BibliographicTermsType::class, $bibliographicTerm);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($bibliographicTerm);
            $em->flush();

            $this->addFlash('success', 'The new bibliographicTerm was created.');
            return $this->redirectToRoute('bibliographic_terms_show', array('id' => $bibliographicTerm->getId()));
        }

        return array(
            'bibliographicTerm' => $bibliographicTerm,
            'form' => $form->createView(),
        );
    }

    /**
     * Creates a new BibliographicTerms entity in a popup.
     *
     * @param Request $request
     *
     * @return array|RedirectResponse
     *
     * @Security("has_role('ROLE_CONTENT_ADMIN')")
     * @Route("/new_popup", name="bibliographic_terms_new_popup")
     * @Method({"GET", "POST"})
     * @Template()
     */
    public function newPopupAction(Request $request) {
        return $this->newAction($request);
    }

    /**
     * Finds and displays a BibliographicTerms entity.
     *
     * @param BibliographicTerms $bibliographicTerm
     *
     * @return array
     *
     * @Route("/{id}", name="bibliographic_terms_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction(BibliographicTerms $bibliographicTerm) {

        return array(
            'bibliographicTerm' => $bibliographicTerm,
        );
    }

    /**
     * Displays a form to edit an existing BibliographicTerms entity.
     *
     *
     * @param Request $request
     * @param BibliographicTerms $bibliographicTerm
     *
     * @return array|RedirectResponse
     *
     * @Security("has_role('ROLE_CONTENT_ADMIN')")
     * @Route("/{id}/edit", name="bibliographic_terms_edit")
     * @Method({"GET", "POST"})
     * @Template()
     */
    public function editAction(Request $request, BibliographicTerms $bibliographicTerm) {
        $editForm = $this->createForm(BibliographicTermsType::class, $bibliographicTerm);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->flush();
            $this->addFlash('success', 'The bibliographicTerm has been updated.');
            return $this->redirectToRoute('bibliographic_terms_show', array('id' => $bibliographicTerm->getId()));
        }

        return array(
            'bibliographicTerm' => $bibliographicTerm,
            'edit_form' => $editForm->createView(),
        );
    }

    /**
     * Deletes a BibliographicTerms entity.
     *
     *
     * @param Request $request
     * @param BibliographicTerms $bibliographicTerm
     *
     * @return array|RedirectResponse
     *
     * @Security("has_role('ROLE_CONTENT_ADMIN')")
     * @Route("/{id}/delete", name="bibliographic_terms_delete")
     * @Method("GET")
     */
    public function deleteAction(Request $request, BibliographicTerms $bibliographicTerm) {
        $em = $this->getDoctrine()->getManager();
        $em->remove($bibliographicTerm);
        $em->flush();
        $this->addFlash('success', 'The bibliographicTerm was deleted.');

        return $this->redirectToRoute('bibliographic_terms_index');
    }

}
