<?php

declare(strict_types=1);

/*
 * (c) 2021 Michael Joyce <mjoyce@sfu.ca>
 * This source file is subject to the GPL v2, bundled
 * with this source code in the file LICENSE.
 */

namespace App\Controller;

use App\Entity\Book;
use App\Entity\Subject;
use App\Form\SubjectType;
use App\Repository\SubjectRepository;
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
 * Subject controller.
 *
 * @Route("/subject")
 */
class SubjectController extends AbstractController implements PaginatorAwareInterface {
    use PaginatorTrait;

    /**
     * Lists all Subject entities.
     *
     * @return array
     *
     * @Route("/", name="subject_index", methods={"GET"})")
     *
     * @Template
     */
    public function indexAction(Request $request, EntityManagerInterface $em) {
        $qb = $em->createQueryBuilder();
        $qb->select('e')->from(Subject::class, 'e')->orderBy('e.subjectName', 'ASC');
        $query = $qb->getQuery();

        $subjects = $this->paginator->paginate($query, $request->query->getint('page', 1), 25);

        return [
            'subjects' => $subjects,
        ];
    }

    /**
     * Typeahead API endpoint for Subject entities.
     *
     * @Route("/typeahead", name="subject_typeahead", methods={"GET"})")
     *
     * @return JsonResponse
     */
    public function typeahead(Request $request, SubjectRepository $repo) {
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
     * Search for Subject entities.
     *
     * @Route("/search", name="subject_search", methods={"GET"})")
     *
     * @Template
     */
    public function searchAction(Request $request, SubjectRepository $repo) {
        $q = $request->query->get('q');
        if ($q) {
            $query = $repo->searchQuery($q);

            $subjects = $this->paginator->paginate($query, $request->query->getInt('page', 1), 25);
        } else {
            $subjects = [];
        }

        return [
            'subjects' => $subjects,
            'q' => $q,
        ];
    }

    /**
     * Creates a new Subject entity.
     *
     * @return array|RedirectResponse
     *
     * @Security("is_granted('ROLE_CONTENT_ADMIN')")
     * @Route("/new", name="subject_new", methods={"GET", "POST"})")
     *
     * @Template
     */
    public function newAction(Request $request, EntityManagerInterface $em) {
        $subject = new Subject();
        $form = $this->createForm(SubjectType::class, $subject);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($subject);
            $em->flush();

            $this->addFlash('success', 'The new subject was created.');

            return $this->redirectToRoute('subject_show', ['id' => $subject->getId()]);
        }

        return [
            'subject' => $subject,
            'form' => $form->createView(),
        ];
    }

    /**
     * Creates a new Subject entity in a popup.
     *
     * @return array|RedirectResponse
     *
     * @Security("is_granted('ROLE_CONTENT_ADMIN')")
     * @Route("/new_popup", name="subject_new_popup", methods={"GET", "POST"})")
     *
     * @Template
     */
    public function newPopupAction(Request $request) {
        return $this->newAction($request);
    }

    /**
     * Finds and displays a Subject entity.
     *
     * @return array
     *
     * @Route("/{id}", name="subject_show", methods={"GET"})")
     *
     * @Template
     */
    public function showAction(Subject $subject) {
        $iterator = $subject->getBooks()->getIterator();
        $iterator->uasort(fn (Book $a, Book $b) => strcasecmp($a->getTitle(), $b->getTitle()));

        return [
            'subject' => $subject,
            'books' => $iterator,
        ];
    }

    /**
     * Displays a form to edit an existing Subject entity.
     *
     * @return array|RedirectResponse
     *
     * @Security("is_granted('ROLE_CONTENT_ADMIN')")
     * @Route("/{id}/edit", name="subject_edit", methods={"GET", "POST"})")
     *
     * @Template
     */
    public function editAction(Request $request, Subject $subject, EntityManagerInterface $em) {
        $editForm = $this->createForm(SubjectType::class, $subject);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em->flush();
            $this->addFlash('success', 'The subject has been updated.');

            return $this->redirectToRoute('subject_show', ['id' => $subject->getId()]);
        }

        return [
            'subject' => $subject,
            'edit_form' => $editForm->createView(),
        ];
    }

    /**
     * Displays a form to edit an existing Subject entity.
     *
     * @return array|RedirectResponse
     *
     * @Security("is_granted('ROLE_CONTENT_ADMIN')")
     * @Route("/{id}/merge", name="subject_merge", methods={"GET", "POST"})")
     *
     * @Template
     */
    public function mergeAction(Request $request, Subject $subject, MergeService $ms, SubjectRepository $repo) {
        if ('POST' === $request->getMethod()) {
            $subjects = $repo->findBy(['id' => $request->request->get('subjects')]);
            $ms->subjects($subject, $subjects);
            $this->addFlash('success', 'The subjects have been merged.');

            return $this->redirectToRoute('subject_show', ['id' => $subject->getId()]);
        }

        $q = $request->get('q');
        if ($q) {
            $subjects = $repo->searchQuery($q)->execute();
        } else {
            $subjects = [];
        }

        return [
            'subject' => $subject,
            'subjects' => $subjects,
            'q' => '',
        ];
    }

    /**
     * Deletes a Subject entity.
     *
     * @return array|RedirectResponse
     *
     * @Security("is_granted('ROLE_CONTENT_ADMIN')")
     * @Route("/{id}/delete", name="subject_delete", methods={"GET"})")
     */
    public function deleteAction(Request $request, Subject $subject, EntityManagerInterface $em) {
        $em->remove($subject);
        $em->flush();
        $this->addFlash('success', 'The subject was deleted.');

        return $this->redirectToRoute('subject_index');
    }
}
