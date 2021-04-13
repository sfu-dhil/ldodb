<?php

declare(strict_types=1);

/*
 * (c) 2020 Michael Joyce <mjoyce@sfu.ca>
 * This source file is subject to the GPL v2, bundled
 * with this source code in the file LICENSE.
 */

namespace App\Controller;

use App\Entity\Keyword;
use App\Form\KeywordType;
use App\Repository\KeywordRepository;
use App\Service\MergeService;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Bundle\PaginatorBundle\Definition\PaginatorAwareInterface;
use Nines\UtilBundle\Controller\PaginatorTrait;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Keyword controller.
 *
 * @Route("/keyword")
 */
class KeywordController extends AbstractController implements PaginatorAwareInterface
{
    use PaginatorTrait;

    /**
     * Lists all Keyword entities.
     *
     * @return array
     *
     * @Route("/", name="keyword_index", methods={"GET"})")
     *
     * @Template
     */
    public function indexAction(Request $request, EntityManagerInterface $em) {
        $qb = $em->createQueryBuilder();
        $qb->select('e')->from(Keyword::class, 'e')->orderBy('e.keyword', 'ASC');
        $query = $qb->getQuery();

        $keywords = $this->paginator->paginate($query, $request->query->getint('page', 1), 25);

        return [
            'keywords' => $keywords,
        ];
    }

    /**
     * Typeahead API endpoint for Keyword entities.
     *
     * @Route("/typeahead", name="keyword_typeahead", methods={"GET"})")
     *
     * @return JsonResponse
     */
    public function typeahead(Request $request, KeywordRepository $repo) {
        $q = $request->query->get('q');
        if ( ! $q) {
            return new JsonResponse([]);
        }

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
     * @Route("/search", name="keyword_search", methods={"GET"})")
     *
     * @Template
     */
    public function searchAction(Request $request, KeywordRepository $repo) {
        $q = $request->query->get('q');
        if ($q) {
            $query = $repo->searchQuery($q);

            $keywords = $this->paginator->paginate($query, $request->query->getInt('page', 1), 25);
        } else {
            $keywords = [];
        }

        return [
            'keywords' => $keywords,
            'q' => $q,
        ];
    }

    /**
     * Creates a new Keyword entity.
     *
     * @return array|RedirectResponse
     *
     * @Security("is_granted('ROLE_CONTENT_ADMIN')")
     * @Route("/new", name="keyword_new", methods={"GET", "POST"})")
     *
     * @Template
     */
    public function newAction(Request $request, EntityManagerInterface $em) {
        $keyword = new Keyword();
        $form = $this->createForm(KeywordType::class, $keyword);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($keyword);
            $em->flush();

            $this->addFlash('success', 'The new keyword was created.');

            return $this->redirectToRoute('keyword_show', ['id' => $keyword->getId()]);
        }

        return [
            'keyword' => $keyword,
            'form' => $form->createView(),
        ];
    }

    /**
     * Creates a new Keyword entity in a popup.
     *
     * @return array|RedirectResponse
     *
     * @Security("is_granted('ROLE_CONTENT_ADMIN')")
     * @Route("/new_popup", name="keyword_new_popup", methods={"GET", "POST"})")
     *
     * @Template
     */
    public function newPopupAction(Request $request, EntityManagerInterface $em) {
        return $this->newAction($request, $em);
    }

    /**
     * Finds and displays a Keyword entity.
     *
     * @return array
     *
     * @Route("/{id}", name="keyword_show", methods={"GET"})")
     *
     * @Template
     */
    public function showAction(Keyword $keyword) {
        return [
            'keyword' => $keyword,
        ];
    }

    /**
     * Displays a form to edit an existing Keyword entity.
     *
     * @return array|RedirectResponse
     *
     * @Security("is_granted('ROLE_CONTENT_ADMIN')")
     * @Route("/{id}/edit", name="keyword_edit", methods={"GET", "POST"})")
     *
     * @Template
     */
    public function editAction(Request $request, Keyword $keyword, EntityManagerInterface $em) {
        $editForm = $this->createForm(KeywordType::class, $keyword);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em->flush();
            $this->addFlash('success', 'The keyword has been updated.');

            return $this->redirectToRoute('keyword_show', ['id' => $keyword->getId()]);
        }

        return [
            'keyword' => $keyword,
            'edit_form' => $editForm->createView(),
        ];
    }

    /**
     * Displays a form to edit an existing Keyword entity.
     *
     * @return array|RedirectResponse
     *
     * @Security("is_granted('ROLE_CONTENT_ADMIN')")
     * @Route("/{id}/merge", name="keyword_merge", methods={"GET", "POST"})")
     *
     * @Template
     */
    public function mergeAction(Request $request, Keyword $keyword, MergeService $ms, KeywordRepository $repo) {
        if ('POST' === $request->getMethod()) {
            $keywords = $repo->findBy(['id' => $request->request->get('keywords')]);
            $ms->keywords($keyword, $keywords);
            $this->addFlash('success', 'The keywords have been merged.');

            return $this->redirectToRoute('keyword_show', ['id' => $keyword->getId()]);
        }

        $q = $request->get('q');
        if ($q) {
            $keywords = $repo->searchQuery($q)->execute();
        } else {
            $keywords = [];
        }

        return [
            'keyword' => $keyword,
            'keywords' => $keywords,
            'q' => '',
        ];
    }

    /**
     * Deletes a Keyword entity.
     *
     * @return array|RedirectResponse
     *
     * @Security("is_granted('ROLE_CONTENT_ADMIN')")
     * @Route("/{id}/delete", name="keyword_delete", methods={"GET"})")
     */
    public function deleteAction(Request $request, Keyword $keyword, EntityManagerInterface $em) {
        $em->remove($keyword);
        $em->flush();
        $this->addFlash('success', 'The keyword was deleted.');

        return $this->redirectToRoute('keyword_index');
    }
}
