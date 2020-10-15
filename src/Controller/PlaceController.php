<?php

declare(strict_types=1);

/*
 * (c) 2020 Michael Joyce <mjoyce@sfu.ca>
 * This source file is subject to the GPL v2, bundled
 * with this source code in the file LICENSE.
 */

namespace App\Controller;

use App\Entity\Place;
use App\Form\PlaceType;
use App\Repository\PlaceRepository;
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
 * Place controller.
 *
 * @Route("/place")
 */
class PlaceController extends AbstractController implements PaginatorAwareInterface {
    use PaginatorTrait;

    /**
     * Lists all Place entities.
     *
     * @return array
     *
     * @Route("/", name="place_index", methods={"GET"})")
     *
     * @Template()
     */
    public function indexAction(Request $request, EntityManagerInterface $em) {
        $qb = $em->createQueryBuilder();
        $qb->select('e')->from(Place::class, 'e')->orderBy('e.placeName', 'ASC');
        $query = $qb->getQuery();

        $places = $this->paginator->paginate($query, $request->query->getint('page', 1), 25);

        return [
            'places' => $places,
        ];
    }

    /**
     * Typeahead API endpoint for Place entities.
     *
     * @Route("/typeahead", name="place_typeahead", methods={"GET"})")
     *
     * @return JsonResponse
     */
    public function typeahead(Request $request, PlaceRepository $repo) {
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
     * Search for Place entities.
     *
     * @Route("/search", name="place_search", methods={"GET"})")
     *
     * @Template()
     */
    public function searchAction(Request $request, PlaceRepository $repo) {
        $q = $request->query->get('q');
        if ($q) {
            $query = $repo->searchQuery($q);

            $places = $this->paginator->paginate($query, $request->query->getInt('page', 1), 25);
        } else {
            $places = [];
        }

        return [
            'places' => $places,
            'q' => $q,
        ];
    }

    /**
     * Creates a new Place entity.
     *
     * @return array|RedirectResponse
     *
     * @Security("is_granted('ROLE_CONTENT_ADMIN')")
     * @Route("/new", name="place_new", methods={"GET","POST"})")
     *
     * @Template()
     */
    public function newAction(Request $request, EntityManagerInterface $em) {
        $place = new Place();
        $form = $this->createForm(PlaceType::class, $place);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($place);
            $em->flush();

            $this->addFlash('success', 'The new place was created.');

            return $this->redirectToRoute('place_show', ['id' => $place->getId()]);
        }

        return [
            'place' => $place,
            'form' => $form->createView(),
        ];
    }

    /**
     * Creates a new Place entity in a popup.
     *
     * @return array|RedirectResponse
     *
     * @Security("is_granted('ROLE_CONTENT_ADMIN')")
     * @Route("/new_popup", name="place_new_popup", methods={"GET","POST"})")
     *
     * @Template()
     */
    public function newPopupAction(Request $request) {
        return $this->newAction($request);
    }

    /**
     * Finds and displays a Place entity.
     *
     * @return array
     *
     * @Route("/{id}", name="place_show", methods={"GET"})")
     *
     * @Template()
     */
    public function showAction(Place $place) {
        return [
            'place' => $place,
        ];
    }

    /**
     * Displays a form to edit an existing Place entity.
     *
     * @return array|RedirectResponse
     *
     * @Security("is_granted('ROLE_CONTENT_ADMIN')")
     * @Route("/{id}/edit", name="place_edit", methods={"GET","POST"})")
     *
     * @Template()
     */
    public function editAction(Request $request, Place $place, EntityManagerInterface $em) {
        $editForm = $this->createForm(PlaceType::class, $place);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em->flush();
            $this->addFlash('success', 'The place has been updated.');

            return $this->redirectToRoute('place_show', ['id' => $place->getId()]);
        }

        return [
            'place' => $place,
            'edit_form' => $editForm->createView(),
        ];
    }

    /**
     * Deletes a Place entity.
     *
     * @return array|RedirectResponse
     *
     * @Security("is_granted('ROLE_CONTENT_ADMIN')")
     * @Route("/{id}/delete", name="place_delete", methods={"GET"})")
     */
    public function deleteAction(Request $request, Place $place, EntityManagerInterface $em) {
        $em->remove($place);
        $em->flush();
        $this->addFlash('success', 'The place was deleted.');

        return $this->redirectToRoute('place_index');
    }
}
