<?php

declare(strict_types=1);

/*
 * (c) 2020 Michael Joyce <mjoyce@sfu.ca>
 * This source file is subject to the GPL v2, bundled
 * with this source code in the file LICENSE.
 */

namespace App\Controller;

use App\Entity\Book;
use App\Form\BookSearchType;
use App\Form\BookType;
use App\Repository\BookRepository;
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
 * Book controller.
 *
 * @Route("/book")
 */
class BookController extends AbstractController implements PaginatorAwareInterface
{
    use PaginatorTrait;

    /**
     * Lists all Book entities.
     *
     * @return array
     *
     * @Route("/", name="book_index", methods={"GET"})")
     *
     * @Template
     */
    public function indexAction(Request $request, EntityManagerInterface $em) {
        $qb = $em->createQueryBuilder();
        $qb->select('e')->from(Book::class, 'e')->orderBy('e.title', 'ASC');
        $query = $qb->getQuery();

        $books = $this->paginator->paginate($query, $request->query->getint('page', 1), 25);
        $form = $this->createForm(BookSearchType::class, null, [
            'action' => $this->generateUrl('book_search'),
        ]);

        return [
            'books' => $books,
            'form' => $form->createView(),
        ];
    }

    /**
     * Typeahead API endpoint for Book entities.
     *
     * @Route("/typeahead", name="book_typeahead", methods={"GET"})")
     *
     * @return JsonResponse
     */
    public function typeahead(Request $request, BookRepository $repo) {
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
     * Search for Book entities.
     *
     * @Route("/search", name="book_search", methods={"GET"})")
     *
     * @Template
     */
    public function searchAction(Request $request, BookRepository $repo) {
        $form = $this->createForm(BookSearchType::class);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $query = $repo->advancedSearchQuery($form->getData());
            $books = $this->paginator->paginate($query, $request->query->getInt('page', 1), 25);
        } else {
            $books = [];
        }

        return [
            'books' => $books,
            'form' => $form->createView(),
        ];
    }

    /**
     * Creates a new Book entity.
     *
     * @return array|RedirectResponse
     *
     * @Security("is_granted('ROLE_CONTENT_ADMIN')")
     * @Route("/new", name="book_new", methods={"GET", "POST"})")
     *
     * @Template
     */
    public function newAction(Request $request, EntityManagerInterface $em) {
        $book = new Book();
        $form = $this->createForm(BookType::class, $book);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            foreach ($book->getContributions() as $contribution) {
                $contribution->setBook($book);
            }

            $em->persist($book);
            $em->flush();

            $this->addFlash('success', 'The new book was created.');

            return $this->redirectToRoute('book_show', ['id' => $book->getId()]);
        }

        return [
            'book' => $book,
            'form' => $form->createView(),
        ];
    }

    /**
     * Creates a new Book entity in a popup.
     *
     * @return array|RedirectResponse
     *
     * @Security("is_granted('ROLE_CONTENT_ADMIN')")
     * @Route("/new_popup", name="book_new_popup", methods={"GET", "POST"})")
     *
     * @Template
     */
    public function newPopupAction(Request $request) {
        return $this->newAction($request);
    }

    /**
     * Finds and displays a Book entity.
     *
     * @return array
     *
     * @Route("/{id}", name="book_show", methods={"GET"})")
     *
     * @Template
     */
    public function showAction(Book $book) {
        return [
            'book' => $book,
        ];
    }

    /**
     * Displays a form to edit an existing Book entity.
     *
     * @return array|RedirectResponse
     *
     * @Security("is_granted('ROLE_CONTENT_ADMIN')")
     * @Route("/{id}/edit", name="book_edit", methods={"GET", "POST"})")
     *
     * @Template
     */
    public function editAction(Request $request, Book $book, EntityManagerInterface $em) {
        $editForm = $this->createForm(BookType::class, $book);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            foreach ($book->getContributions() as $contribution) {
                $contribution->setBook($book);
            }

            $em->flush();
            $this->addFlash('success', 'The book has been updated.');

            return $this->redirectToRoute('book_show', ['id' => $book->getId()]);
        }

        return [
            'book' => $book,
            'edit_form' => $editForm->createView(),
        ];
    }

    /**
     * Deletes a Book entity.
     *
     * @return array|RedirectResponse
     *
     * @Security("is_granted('ROLE_CONTENT_ADMIN')")
     * @Route("/{id}/delete", name="book_delete", methods={"GET"})")
     */
    public function deleteAction(Request $request, Book $book, EntityManagerInterface $em) {
        $em->remove($book);
        $em->flush();
        $this->addFlash('success', 'The book was deleted.');

        return $this->redirectToRoute('book_index');
    }
}
