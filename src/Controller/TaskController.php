<?php

declare(strict_types=1);

/*
 * (c) 2021 Michael Joyce <mjoyce@sfu.ca>
 * This source file is subject to the GPL v2, bundled
 * with this source code in the file LICENSE.
 */

namespace App\Controller;

use App\Entity\Task;
use App\Form\TaskType;
use App\Repository\ContributionRepository;
use App\Repository\TaskRepository;
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
 * Task controller.
 *
 * @Route("/task")
 */
class TaskController extends AbstractController implements PaginatorAwareInterface {
    use PaginatorTrait;

    /**
     * Lists all Task entities.
     *
     * @return array
     *
     * @Route("/", name="task_index", methods={"GET"})")
     *
     * @Template
     */
    public function indexAction(Request $request, EntityManagerInterface $em) {
        $qb = $em->createQueryBuilder();
        $qb->select('e')->from(Task::class, 'e')->orderBy('e.id', 'ASC');
        $query = $qb->getQuery();

        $tasks = $this->paginator->paginate($query, $request->query->getint('page', 1), 25);

        return [
            'tasks' => $tasks,
        ];
    }

    /**
     * Typeahead API endpoint for Task entities.
     *
     * @Route("/typeahead", name="task_typeahead", methods={"GET"})")
     *
     * @return JsonResponse
     */
    public function typeahead(Request $request, TaskRepository $repo) {
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
     * Creates a new Task entity.
     *
     * @return array|RedirectResponse
     *
     * @Security("is_granted('ROLE_CONTENT_ADMIN')")
     * @Route("/new", name="task_new", methods={"GET", "POST"})")
     *
     * @Template
     */
    public function newAction(Request $request, EntityManagerInterface $em) {
        $task = new Task();
        $form = $this->createForm(TaskType::class, $task);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($task);
            $em->flush();

            $this->addFlash('success', 'The new task was created.');

            return $this->redirectToRoute('task_show', ['id' => $task->getId()]);
        }

        return [
            'task' => $task,
            'form' => $form->createView(),
        ];
    }

    /**
     * Creates a new Task entity in a popup.
     *
     * @return array|RedirectResponse
     *
     * @Security("is_granted('ROLE_CONTENT_ADMIN')")
     * @Route("/new_popup", name="task_new_popup", methods={"GET", "POST"})")
     *
     * @Template
     */
    public function newPopupAction(Request $request) {
        return $this->newAction($request);
    }

    /**
     * Finds and displays a Task entity.
     *
     * @return array
     *
     * @Route("/{id}", name="task_show", methods={"GET"})")
     *
     * @Template
     */
    public function showAction(Task $task) {
        return [
            'task' => $task,
        ];
    }

    /**
     * Displays a form to edit an existing Task entity.
     *
     * @return array|RedirectResponse
     *
     * @Security("is_granted('ROLE_CONTENT_ADMIN')")
     * @Route("/{id}/edit", name="task_edit", methods={"GET", "POST"})")
     *
     * @Template
     */
    public function editAction(Request $request, Task $task, EntityManagerInterface $em) {
        $editForm = $this->createForm(TaskType::class, $task);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em->flush();
            $this->addFlash('success', 'The task has been updated.');

            return $this->redirectToRoute('task_show', ['id' => $task->getId()]);
        }

        return [
            'task' => $task,
            'edit_form' => $editForm->createView(),
        ];
    }

    /**
     * Deletes a Task entity.
     *
     * @return array|RedirectResponse
     *
     * @Security("is_granted('ROLE_CONTENT_ADMIN')")
     * @Route("/{id}/delete", name="task_delete", methods={"GET"})")
     */
    public function deleteAction(Request $request, Task $task, EntityManagerInterface $em) {
        $em->remove($task);
        $em->flush();
        $this->addFlash('success', 'The task was deleted.');

        return $this->redirectToRoute('task_index');
    }
}
