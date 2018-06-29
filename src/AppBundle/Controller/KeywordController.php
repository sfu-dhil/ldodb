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
use AppBundle\Entity\Keyword;
use AppBundle\Form\KeywordType;

/**
 * Keyword controller.
 *
 * @Security("has_role('ROLE_USER')")
 * @Route("/keyword")
 */
class KeywordController extends Controller {

    /**
     * Lists all Keyword entities.
     *
     * @param Request $request
     *
     * @return array
     *
     * @Route("/", name="keyword_index")
     * @Method("GET")
     * @Template()
     */
    public function indexAction(Request $request) {
        $em = $this->getDoctrine()->getManager();
        $qb = $em->createQueryBuilder();
        $qb->select('e')->from(Keyword::class, 'e')->orderBy('e.id', 'ASC');
        $query = $qb->getQuery();
        $paginator = $this->get('knp_paginator');
        $keywords = $paginator->paginate($query, $request->query->getint('page', 1), 25);

        return array(
            'keywords' => $keywords,
        );
    }

    /**
     * Typeahead API endpoint for Keyword entities.
     *
     * @param Request $request
     *
     * @Route("/typeahead", name="keyword_typeahead")
     * @Method("GET")
     * @return JsonResponse
     */
    public function typeahead(Request $request) {
        $q = $request->query->get('q');
        if (!$q) {
            return new JsonResponse([]);
        }
        $em = $this->getDoctrine()->getManager();
        $repo = $em->getRepository(Keyword::class);
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
     * Search for Keyword entities.
     *
     * @param Request $request
     *
     * @Route("/search", name="keyword_search")
     * @Method("GET")
     * @Template()
     */
    public function searchAction(Request $request) {
        $em = $this->getDoctrine()->getManager();
        $repo = $em->getRepository('AppBundle:Keyword');
        $q = $request->query->get('q');
        if ($q) {
            $query = $repo->searchQuery($q);
            $paginator = $this->get('knp_paginator');
            $keywords = $paginator->paginate($query, $request->query->getInt('page', 1), 25);
        } else {
            $keywords = array();
        }

        return array(
            'keywords' => $keywords,
            'q' => $q,
        );
    }

    /**
     * Creates a new Keyword entity.
     *
     * @param Request $request
     *
     * @return array|RedirectResponse
     *
     * @Security("has_role('ROLE_CONTENT_ADMIN')")
     * @Route("/new", name="keyword_new")
     * @Method({"GET", "POST"})
     * @Template()
     */
    public function newAction(Request $request) {
        $keyword = new Keyword();
        $form = $this->createForm(KeywordType::class, $keyword);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($keyword);
            $em->flush();

            $this->addFlash('success', 'The new keyword was created.');
            return $this->redirectToRoute('keyword_show', array('id' => $keyword->getId()));
        }

        return array(
            'keyword' => $keyword,
            'form' => $form->createView(),
        );
    }

    /**
     * Creates a new Keyword entity in a popup.
     *
     * @param Request $request
     *
     * @return array|RedirectResponse
     *
     * @Security("has_role('ROLE_CONTENT_ADMIN')")
     * @Route("/new_popup", name="keyword_new_popup")
     * @Method({"GET", "POST"})
     * @Template()
     */
    public function newPopupAction(Request $request) {
        return $this->newAction($request);
    }

    /**
     * Finds and displays a Keyword entity.
     *
     * @param Keyword $keyword
     *
     * @return array
     *
     * @Route("/{id}", name="keyword_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction(Keyword $keyword) {

        return array(
            'keyword' => $keyword,
        );
    }

    /**
     * Displays a form to edit an existing Keyword entity.
     *
     *
     * @param Request $request
     * @param Keyword $keyword
     *
     * @return array|RedirectResponse
     *
     * @Security("has_role('ROLE_CONTENT_ADMIN')")
     * @Route("/{id}/edit", name="keyword_edit")
     * @Method({"GET", "POST"})
     * @Template()
     */
    public function editAction(Request $request, Keyword $keyword) {
        $editForm = $this->createForm(KeywordType::class, $keyword);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->flush();
            $this->addFlash('success', 'The keyword has been updated.');
            return $this->redirectToRoute('keyword_show', array('id' => $keyword->getId()));
        }

        return array(
            'keyword' => $keyword,
            'edit_form' => $editForm->createView(),
        );
    }

    /**
     * Deletes a Keyword entity.
     *
     *
     * @param Request $request
     * @param Keyword $keyword
     *
     * @return array|RedirectResponse
     *
     * @Security("has_role('ROLE_CONTENT_ADMIN')")
     * @Route("/{id}/delete", name="keyword_delete")
     * @Method("GET")
     */
    public function deleteAction(Request $request, Keyword $keyword) {
        $em = $this->getDoctrine()->getManager();
        $em->remove($keyword);
        $em->flush();
        $this->addFlash('success', 'The keyword was deleted.');

        return $this->redirectToRoute('keyword_index');
    }

}
