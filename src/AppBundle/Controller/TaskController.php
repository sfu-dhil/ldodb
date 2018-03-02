<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Task;
use AppBundle\Form\TaskType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Task controller.
 *
 * @Route("/task")
 */
class TaskController extends Controller {

    /**
     * Lists all Task entities.
     *
     * @Route("/", name="task_index")
     * @Method("GET")
     * @Template()
     * @param Request $request
     */
    public function indexAction(Request $request) {
        $em = $this->getDoctrine()->getManager();
        $qb = $em->createQueryBuilder();
        $qb->select('e')->from(Task::class, 'e')->orderBy('e.taskName', 'ASC');
        $query = $qb->getQuery();
        $paginator = $this->get('knp_paginator');
        $tasks = $paginator->paginate($query, $request->query->getint('page', 1), 25);

        return array(
            'tasks' => $tasks,
        );
    }

    /**
     * Creates a new Task entity.
     *
     * @Route("/new", name="task_new")
     * @Method({"GET", "POST"})
     * @Security("has_role('ROLE_CONTENT_ADMIN')")
     * @Template()
     * @param Request $request
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
     * Finds and displays a Task entity.
     *
     * @Route("/{id}", name="task_show")
     * @Method("GET")
     * @Template()
     * @param Task $task
     */
    public function showAction(Task $task) {

        return array(
            'task' => $task,
        );
    }

    /**
     * Displays a form to edit an existing Task entity.
     *
     * @Route("/{id}/edit", name="task_edit")
     * @Method({"GET", "POST"})
     * @Security("has_role('ROLE_CONTENT_ADMIN')")
     * @Template()
     * @param Request $request
     * @param Task $task
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
     * @Route("/{id}/delete", name="task_delete")
     * @Method("GET")
     * @Security("has_role('ROLE_CONTENT_ADMIN')")
     * @param Request $request
     * @param Task $task
     */
    public function deleteAction(Request $request, Task $task) {
        $em = $this->getDoctrine()->getManager();
        $em->remove($task);
        $em->flush();
        $this->addFlash('success', 'The task was deleted.');

        return $this->redirectToRoute('task_index');
    }

}
