<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
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
 * @Route("/binding")
 */
class BindingFeatureController extends Controller {

    /**
     * Lists all BindingFeature entities.
     *
     * @Route("/", name="binding_index")
     * @Method("GET")
     * @Template()
     * @param Request $request
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
     * Search for BindingFeature entities.
     *
     * To make this work, add a method like this one to the 
     * AppBundle:BindingFeature repository. Replace the fieldName with
     * something appropriate, and adjust the generated search.html.twig
     * template.
     * 
      //    public function searchQuery($q) {
      //        $qb = $this->createQueryBuilder('e');
      //        $qb->where("e.fieldName like '%$q%'");
      //        return $qb->getQuery();
      //    }
     *
     *
     * @Route("/search", name="binding_search")
     * @Method("GET")
     * @Template()
     * @param Request $request
     */
    public function searchAction(Request $request) {
        $em = $this->getDoctrine()->getManager();
        $repo = $em->getRepository('AppBundle:BindingFeature');
        $q = $request->query->get('q');
        if ($q) {
            $query = $repo->searchQuery($q);
            $paginator = $this->get('knp_paginator');
            $bindingFeatures = $paginator->paginate($query, $request->query->getInt('page', 1), 25);
        } else {
            $bindingFeatures = array();
        }

        return array(
            'bindingFeatures' => $bindingFeatures,
            'q' => $q,
        );
    }

    /**
     * Full text search for BindingFeature entities.
     *
     * To make this work, add a method like this one to the 
     * AppBundle:BindingFeature repository. Replace the fieldName with
     * something appropriate, and adjust the generated fulltext.html.twig
     * template.
     * 
      //    public function fulltextQuery($q) {
      //        $qb = $this->createQueryBuilder('e');
      //        $qb->addSelect("MATCH_AGAINST (e.name, :q 'IN BOOLEAN MODE') as score");
      //        $qb->add('where', "MATCH_AGAINST (e.name, :q 'IN BOOLEAN MODE') > 0.5");
      //        $qb->orderBy('score', 'desc');
      //        $qb->setParameter('q', $q);
      //        return $qb->getQuery();
      //    }
     * 
     * Requires a MatchAgainst function be added to doctrine, and appropriate
     * fulltext indexes on your BindingFeature entity.
     *     ORM\Index(name="alias_name_idx",columns="name", flags={"fulltext"})
     *
     *
     * @Route("/fulltext", name="binding_fulltext")
     * @Method("GET")
     * @Template()
     * @param Request $request
     * @return array
     */
    public function fulltextAction(Request $request) {
        $em = $this->getDoctrine()->getManager();
        $repo = $em->getRepository('AppBundle:BindingFeature');
        $q = $request->query->get('q');
        if ($q) {
            $query = $repo->fulltextQuery($q);
            $paginator = $this->get('knp_paginator');
            $bindingFeatures = $paginator->paginate($query, $request->query->getInt('page', 1), 25);
        } else {
            $bindingFeatures = array();
        }

        return array(
            'bindingFeatures' => $bindingFeatures,
            'q' => $q,
        );
    }

    /**
     * Creates a new BindingFeature entity.
     *
     * @Route("/new", name="binding_new")
     * @Method({"GET", "POST"})
     * @Security("has_role('ROLE_CONTENT_ADMIN')")
     * @Template()
     * @param Request $request
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
            return $this->redirectToRoute('binding_show', array('id' => $bindingFeature->getId()));
        }

        return array(
            'bindingFeature' => $bindingFeature,
            'form' => $form->createView(),
        );
    }

    /**
     * Finds and displays a BindingFeature entity.
     *
     * @Route("/{id}", name="binding_show")
     * @Method("GET")
     * @Template()
     * @param BindingFeature $bindingFeature
     */
    public function showAction(BindingFeature $bindingFeature) {

        return array(
            'bindingFeature' => $bindingFeature,
        );
    }

    /**
     * Displays a form to edit an existing BindingFeature entity.
     *
     * @Route("/{id}/edit", name="binding_edit")
     * @Method({"GET", "POST"})
     * @Security("has_role('ROLE_CONTENT_ADMIN')")
     * @Template()
     * @param Request $request
     * @param BindingFeature $bindingFeature
     */
    public function editAction(Request $request, BindingFeature $bindingFeature) {
        $editForm = $this->createForm(BindingFeatureType::class, $bindingFeature);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->flush();
            $this->addFlash('success', 'The bindingFeature has been updated.');
            return $this->redirectToRoute('binding_show', array('id' => $bindingFeature->getId()));
        }

        return array(
            'bindingFeature' => $bindingFeature,
            'edit_form' => $editForm->createView(),
        );
    }

    /**
     * Deletes a BindingFeature entity.
     *
     * @Route("/{id}/delete", name="binding_delete")
     * @Method("GET")
     * @Security("has_role('ROLE_CONTENT_ADMIN')")
     * @param Request $request
     * @param BindingFeature $bindingFeature
     */
    public function deleteAction(Request $request, BindingFeature $bindingFeature) {
        $em = $this->getDoctrine()->getManager();
        $em->remove($bindingFeature);
        $em->flush();
        $this->addFlash('success', 'The bindingFeature was deleted.');

        return $this->redirectToRoute('binding_index');
    }

}
