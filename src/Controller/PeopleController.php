<?php

declare(strict_types=1);

/*
 * (c) 2021 Michael Joyce <mjoyce@sfu.ca>
 * This source file is subject to the GPL v2, bundled
 * with this source code in the file LICENSE.
 */

namespace App\Controller;

use App\Entity\People;
use App\Form\PeopleType;
use App\Repository\PeopleRepository;
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
 * People controller.
 *
 * @Route("/people")
 */
class PeopleController extends AbstractController implements PaginatorAwareInterface {
    use PaginatorTrait;

    /**
     * Lists all People entities.
     *
     * @return array
     *
     * @Route("/", name="people_index", methods={"GET"})")
     *
     * @Template
     */
    public function indexAction(Request $request, EntityManagerInterface $em) {
        $qb = $em->createQueryBuilder();
        $qb->select('e')->from(People::class, 'e')->orderBy('e.lastName', 'ASC')->addOrderBy('e.firstName', 'ASC');
        $query = $qb->getQuery();

        $people = $this->paginator->paginate($query, $request->query->getint('page', 1), 25);

        return [
            'people' => $people,
        ];
    }

    /**
     * Typeahead API endpoint for People entities.
     *
     * @Route("/typeahead", name="people_typeahead", methods={"GET"})")
     *
     * @return JsonResponse
     */
    public function typeahead(Request $request, PeopleRepository $repo) {
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
     * Search for People entities.
     *
     * @Route("/search", name="people_search", methods={"GET"})")
     *
     * @Template
     */
    public function searchAction(Request $request, PeopleRepository $repo) {
        $q = $request->query->get('q');
        if ($q) {
            $query = $repo->searchQuery($q);

            $people = $this->paginator->paginate($query, $request->query->getInt('page', 1), 25);
        } else {
            $people = [];
        }

        return [
            'people' => $people,
            'q' => $q,
        ];
    }

    /**
     * Creates a new People entity.
     *
     * @return array|RedirectResponse
     *
     * @Security("is_granted('ROLE_CONTENT_ADMIN')")
     * @Route("/new", name="people_new", methods={"GET", "POST"})")
     *
     * @Template
     */
    public function newAction(Request $request, EntityManagerInterface $em) {
        $person = new People();
        $form = $this->createForm(PeopleType::class, $person);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($person);
            $em->flush();

            $this->addFlash('success', 'The new person was created.');

            return $this->redirectToRoute('people_show', ['id' => $person->getId()]);
        }

        return [
            'person' => $person,
            'form' => $form->createView(),
        ];
    }

    /**
     * Creates a new People entity in a popup.
     *
     * @return array|RedirectResponse
     *
     * @Security("is_granted('ROLE_CONTENT_ADMIN')")
     * @Route("/new_popup", name="people_new_popup", methods={"GET", "POST"})")
     *
     * @Template
     */
    public function newPopupAction(Request $request) {
        return $this->newAction($request);
    }

    /**
     * Finds and displays a People entity.
     *
     * @return array
     *
     * @Route("/{id}", name="people_show", methods={"GET"})")
     *
     * @Template
     */
    public function showAction(People $person) {
        return [
            'person' => $person,
        ];
    }

    /**
     * Displays a form to edit an existing People entity.
     *
     * @return array|RedirectResponse
     *
     * @Security("is_granted('ROLE_CONTENT_ADMIN')")
     * @Route("/{id}/edit", name="people_edit", methods={"GET", "POST"})")
     *
     * @Template
     */
    public function editAction(Request $request, People $person, EntityManagerInterface $em) {
        $editForm = $this->createForm(PeopleType::class, $person);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em->flush();
            $this->addFlash('success', 'The person has been updated.');

            return $this->redirectToRoute('people_show', ['id' => $person->getId()]);
        }

        return [
            'person' => $person,
            'edit_form' => $editForm->createView(),
        ];
    }

    /**
     * Deletes a People entity.
     *
     * @return array|RedirectResponse
     *
     * @Security("is_granted('ROLE_CONTENT_ADMIN')")
     * @Route("/{id}/delete", name="people_delete", methods={"GET"})")
     */
    public function deleteAction(Request $request, People $person, EntityManagerInterface $em) {
        $em->remove($person);
        $em->flush();
        $this->addFlash('success', 'The person was deleted.');

        return $this->redirectToRoute('people_index');
    }
}
