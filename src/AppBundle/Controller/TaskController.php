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
use AppBundle\Entity\Task;
use AppBundle\Form\TaskType;

/**
 * Task controller.
 *
 * @Security("has_role('ROLE_USER')")
 * @Route("/task")
 */
class TaskController extends Controller {

    /**
     * Lists all Task entities.
     *
     * @param Request $request
     *
     * @return array
     *
     * @Route("/", name="task_index")
     * @Method("GET")
     * @Template()
     */
    public function indexAction(Request $request) {
        $em = $this->getDoctrine()->getManager();
        $qb = $em->createQueryBuilder();
        $qb->select('e')->from(Task::class, 'e')->orderBy('e.id', 'ASC');
        $query = $qb->getQuery();
        $paginator = $this->get('knp_paginator');
        $tasks = $paginator->paginate($query, $request->query->getint('page', 1), 25);

        return array(
            'tasks' => $tasks,
        );
    }

    /**
     * Typeahead API endpoint for Task entities.
     *
     * @param Request $request
     *
     * @Route("/typeahead", name="task_typeahead")
     * @Method("GET")
     * @return JsonResponse
     */
    public function typeahead(Request $request) {
        $q = $request->query->get('q');
        if (!$q) {
            return new JsonResponse([]);
        }
        $em = $this->getDoctrine()->getManager();
        $repo = $em->getRepository(Task::class);
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
     * @param Request $request
     *
     * @return array|RedirectResponse
     *
     * @Security("has_role('ROLE_CONTENT_ADMIN')")
     * @Route("/new", name="task_new")
     * @Method({"GET", "POST"})
     * @Template()
     */
    public function newAction(Request $request) {
        $task = new Task();
        $form = $this->createForm(TaskType::class, $task);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($task);
            $em->flush();

            $this->addFlash('success', 'The new task was created.');
            return $this->redirectToRoute('task_show', array('id' => $task->getId()));
        }

        return array(
            'task' => $task,
            'form' => $form->createView(),
        );
    }

    /**
     * Creates a new Task entity in a popup.
     *
     * @param Request $request
     *
     * @return array|RedirectResponse
     *
     * @Security("has_role('ROLE_CONTENT_ADMIN')")
     * @Route("/new_popup", name="task_new_popup")
     * @Method({"GET", "POST"})
     * @Template()
     */
    public function newPopupAction(Request $request) {
        return $this->newAction($request);
    }

    /**
     * Finds and displays a Task entity.
     *
     * @param Task $task
     *
     * @return array
     *
     * @Route("/{id}", name="task_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction(Task $task) {

        return array(
            'task' => $task,
        );
    }

    /**
     * Displays a form to edit an existing Task entity.
     *
     *
     * @param Request $request
     * @param Task $task
     *
     * @return array|RedirectResponse
     *
     * @Security("has_role('ROLE_CONTENT_ADMIN')")
     * @Route("/{id}/edit", name="task_edit")
     * @Method({"GET", "POST"})
     * @Template()
     */
    public function editAction(Request $request, Task $task) {
        $editForm = $this->createForm(TaskType::class, $task);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->flush();
            $this->addFlash('success', 'The task has been updated.');
            return $this->redirectToRoute('task_show', array('id' => $task->getId()));
        }

        return array(
            'task' => $task,
            'edit_form' => $editForm->createView(),
        );
    }

    /**
     * Deletes a Task entity.
     *
     *
     * @param Request $request
     * @param Task $task
     *
     * @return array|RedirectResponse
     *
     * @Security("has_role('ROLE_CONTENT_ADMIN')")
     * @Route("/{id}/delete", name="task_delete")
     * @Method("GET")
     */
    public function deleteAction(Request $request, Task $task) {
        $em = $this->getDoctrine()->getManager();
        $em->remove($task);
        $em->flush();
        $this->addFlash('success', 'The task was deleted.');

        return $this->redirectToRoute('task_index');
    }

}
