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
use AppBundle\Entity\BindingFeature;
use AppBundle\Form\BindingFeatureType;

/**
 * BindingFeature controller.
 *
 * @Route("/binding_feature")
 */
class BindingFeatureController extends Controller {

    /**
     * Lists all BindingFeature entities.
     *
     * @param Request $request
     *
     * @return array
     *
     * @Route("/", name="binding_feature_index")
     * @Method("GET")
     * @Template()
     */
    public function indexAction(Request $request) {
        $em = $this->getDoctrine()->getManager();
        $qb = $em->createQueryBuilder();
        $qb->select('e')->from(BindingFeature::class, 'e')->orderBy('e.id', 'ASC');
        $query = $qb->getQuery();
        $paginator = $this->get('knp_paginator');
        $bindingFeatures = $paginator->paginate($query, $request->query->getint('page', 1), 25);

        return array(
            'bindingFeatures' => $bindingFeatures,
        );
    }

    /**
     * Typeahead API endpoint for BindingFeature entities.
     *
     * @param Request $request
     *
     * @Route("/typeahead", name="binding_feature_typeahead")
     * @Method("GET")
     * @return JsonResponse
     */
    public function typeahead(Request $request) {
        $q = $request->query->get('q');
        if (!$q) {
            return new JsonResponse([]);
        }
        $em = $this->getDoctrine()->getManager();
        $repo = $em->getRepository(BindingFeature::class);
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
     * Creates a new BindingFeature entity.
     *
     * @param Request $request
     *
     * @return array|RedirectResponse
     *
     * @Security("has_role('ROLE_CONTENT_ADMIN')")
     * @Route("/new", name="binding_feature_new")
     * @Method({"GET", "POST"})
     * @Template()
     */
    public function newAction(Request $request) {
        $bindingFeature = new BindingFeature();
        $form = $this->createForm(BindingFeatureType::class, $bindingFeature);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($bindingFeature);
            $em->flush();

            $this->addFlash('success', 'The new bindingFeature was created.');
            return $this->redirectToRoute('binding_feature_show', array('id' => $bindingFeature->getId()));
        }

        return array(
            'bindingFeature' => $bindingFeature,
            'form' => $form->createView(),
        );
    }

    /**
     * Creates a new BindingFeature entity in a popup.
     *
     * @param Request $request
     *
     * @return array|RedirectResponse
     *
     * @Security("has_role('ROLE_CONTENT_ADMIN')")
     * @Route("/new_popup", name="binding_feature_new_popup")
     * @Method({"GET", "POST"})
     * @Template()
     */
    public function newPopupAction(Request $request) {
        return $this->newAction($request);
    }

    /**
     * Finds and displays a BindingFeature entity.
     *
     * @param BindingFeature $bindingFeature
     *
     * @return array
     *
     * @Route("/{id}", name="binding_feature_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction(BindingFeature $bindingFeature) {

        return array(
            'bindingFeature' => $bindingFeature,
        );
    }

    /**
     * Displays a form to edit an existing BindingFeature entity.
     *
     *
     * @param Request $request
     * @param BindingFeature $bindingFeature
     *
     * @return array|RedirectResponse
     *
     * @Security("has_role('ROLE_CONTENT_ADMIN')")
     * @Route("/{id}/edit", name="binding_feature_edit")
     * @Method({"GET", "POST"})
     * @Template()
     */
    public function editAction(Request $request, BindingFeature $bindingFeature) {
        $editForm = $this->createForm(BindingFeatureType::class, $bindingFeature);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->flush();
            $this->addFlash('success', 'The bindingFeature has been updated.');
            return $this->redirectToRoute('binding_feature_show', array('id' => $bindingFeature->getId()));
        }

        return array(
            'bindingFeature' => $bindingFeature,
            'edit_form' => $editForm->createView(),
        );
    }

    /**
     * Deletes a BindingFeature entity.
     *
     *
     * @param Request $request
     * @param BindingFeature $bindingFeature
     *
     * @return array|RedirectResponse
     *
     * @Security("has_role('ROLE_CONTENT_ADMIN')")
     * @Route("/{id}/delete", name="binding_feature_delete")
     * @Method("GET")
     */
    public function deleteAction(Request $request, BindingFeature $bindingFeature) {
        $em = $this->getDoctrine()->getManager();
        $em->remove($bindingFeature);
        $em->flush();
        $this->addFlash('success', 'The bindingFeature was deleted.');

        return $this->redirectToRoute('binding_feature_index');
    }

}
