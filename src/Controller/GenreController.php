<?php

declare(strict_types=1);

/*
 * (c) 2020 Michael Joyce <mjoyce@sfu.ca>
 * This source file is subject to the GPL v2, bundled
 * with this source code in the file LICENSE.
 */

namespace App\Controller;

use App\Entity\Genre;
use App\Entity\Keyword;
use App\Form\GenreType;
use App\Repository\GenreRepository;
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
 * Genre controller.
 *
 * @Route("/genre")
 */
class GenreController extends AbstractController implements PaginatorAwareInterface {
    use PaginatorTrait;

    /**
     * Lists all Genre entities.
     *
     * @return array
     *
     * @Route("/", name="genre_index", methods={"GET"})")
     *
     * @Template()
     */
    public function indexAction(Request $request, EntityManagerInterface $em) {
        $qb = $em->createQueryBuilder();
        $qb->select('e')->from(Genre::class, 'e')->orderBy('e.genreName', 'ASC');
        $query = $qb->getQuery();

        $genres = $this->paginator->paginate($query, $request->query->getint('page', 1), 25);

        return [
            'genres' => $genres,
        ];
    }

    /**
     * Typeahead API endpoint for Genre entities.
     *
     * @Route("/typeahead", name="genre_typeahead", methods={"GET"})")
     *
     * @return JsonResponse
     */
    public function typeahead(Request $request, GenreRepository $repo) {
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
     * Creates a new Genre entity.
     *
     * @return array|RedirectResponse
     *
     * @Security("is_granted('ROLE_CONTENT_ADMIN')")
     * @Route("/new", name="genre_new", methods={"GET","POST"})")
     *
     * @Template()
     */
    public function newAction(Request $request, EntityManagerInterface $em) {
        $genre = new Genre();
        $form = $this->createForm(GenreType::class, $genre);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($genre);
            $em->flush();

            $this->addFlash('success', 'The new genre was created.');

            return $this->redirectToRoute('genre_show', ['id' => $genre->getId()]);
        }

        return [
            'genre' => $genre,
            'form' => $form->createView(),
        ];
    }

    /**
     * Creates a new Genre entity in a popup.
     *
     * @return array|RedirectResponse
     *
     * @Security("is_granted('ROLE_CONTENT_ADMIN')")
     * @Route("/new_popup", name="genre_new_popup", methods={"GET","POST"})")
     *
     * @Template()
     */
    public function newPopupAction(Request $request) {
        return $this->newAction($request);
    }

    /**
     * Finds and displays a Genre entity.
     *
     * @return array
     *
     * @Route("/{id}", name="genre_show", methods={"GET"})")
     *
     * @Template()
     */
    public function showAction(Genre $genre) {
        return [
            'genre' => $genre,
        ];
    }

    /**
     * Displays a form to edit an existing Genre entity.
     *
     * @return array|RedirectResponse
     *
     * @Security("is_granted('ROLE_CONTENT_ADMIN')")
     * @Route("/{id}/edit", name="genre_edit", methods={"GET","POST"})")
     *
     * @Template()
     */
    public function editAction(Request $request, Genre $genre, EntityManagerInterface $em) {
        $editForm = $this->createForm(GenreType::class, $genre);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em->flush();
            $this->addFlash('success', 'The genre has been updated.');

            return $this->redirectToRoute('genre_show', ['id' => $genre->getId()]);
        }

        return [
            'genre' => $genre,
            'edit_form' => $editForm->createView(),
        ];
    }

    /**
     * Displays a form to edit an existing Genre entity.
     *
     * @return array|RedirectResponse
     *
     * @Security("is_granted('ROLE_CONTENT_ADMIN')")
     * @Route("/{id}/merge", name="genre_merge", methods={"GET","POST"})")
     *
     * @Template()
     */
    public function mergeAction(Request $request, Genre $genre, MergeService $ms, GenreRepository $repo) {
        if ('POST' === $request->getMethod()) {
            $genres = $repo->findBy(['id' => $request->request->get('genres')]);
            $ms->genres($genre, $genres);
            $this->addFlash('success', 'The genres have been merged.');
            return $this->redirectToRoute('genre_show', ['id' => $genre->getId()]);
        }

        $q = $request->get('q');
        if ($q) {
            $genres = $repo->searchQuery($q)->execute();
        } else {
            $genres = [];
        }

        return [
            'genre' => $genre,
            'genres' => $genres,
            'q' => '',
        ];
    }

    /**
     * Deletes a Genre entity.
     *
     * @return array|RedirectResponse
     *
     * @Security("is_granted('ROLE_CONTENT_ADMIN')")
     * @Route("/{id}/delete", name="genre_delete", methods={"GET"})")
     */
    public function deleteAction(Request $request, Genre $genre, EntityManagerInterface $em) {
        $em->remove($genre);
        $em->flush();
        $this->addFlash('success', 'The genre was deleted.');

        return $this->redirectToRoute('genre_index');
    }
}
