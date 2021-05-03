<?php

declare(strict_types=1);

/*
 * (c) 2020 Michael Joyce <mjoyce@sfu.ca>
 * This source file is subject to the GPL v2, bundled
 * with this source code in the file LICENSE.
 */

namespace App\Controller;

use App\Entity\DigitalCopyHolder;
use App\Form\DigitalCopyHolderType;
use App\Repository\DigitalCopyHolderRepository;
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
 * DigitalCopyHolder controller.
 *
 * @Route("/digital_copy_holder")
 */
class DigitalCopyHolderController extends AbstractController implements PaginatorAwareInterface {
    use PaginatorTrait;

    /**
     * Lists all DigitalCopyHolder entities.
     *
     * @return array
     *
     * @Route("/", name="digital_copy_holder_index", methods={"GET"})")
     *
     * @Template
     */
    public function indexAction(Request $request, EntityManagerInterface $em) {
        $qb = $em->createQueryBuilder();
        $qb->select('e')->from(DigitalCopyHolder::class, 'e')->orderBy('e.id', 'ASC');
        $query = $qb->getQuery();

        $digitalCopyHolders = $this->paginator->paginate($query, $request->query->getint('page', 1), 25);

        return [
            'digitalCopyHolders' => $digitalCopyHolders,
        ];
    }

    /**
     * Typeahead API endpoint for DigitalCopyHolder entities.
     *
     * @Route("/typeahead", name="digital_copy_holder_typeahead", methods={"GET"})")
     *
     * @return JsonResponse
     */
    public function typeahead(Request $request, DigitalCopyHolderRepository $repo) {
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
     * Creates a new DigitalCopyHolder entity.
     *
     * @return array|RedirectResponse
     *
     * @Security("is_granted('ROLE_CONTENT_ADMIN')")
     * @Route("/new", name="digital_copy_holder_new", methods={"GET", "POST"})")
     *
     * @Template
     */
    public function newAction(Request $request, EntityManagerInterface $em) {
        $digitalCopyHolder = new DigitalCopyHolder();
        $form = $this->createForm(DigitalCopyHolderType::class, $digitalCopyHolder);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($digitalCopyHolder);
            $em->flush();

            $this->addFlash('success', 'The new digitalCopyHolder was created.');

            return $this->redirectToRoute('digital_copy_holder_show', ['id' => $digitalCopyHolder->getId()]);
        }

        return [
            'digitalCopyHolder' => $digitalCopyHolder,
            'form' => $form->createView(),
        ];
    }

    /**
     * Creates a new DigitalCopyHolder entity in a popup.
     *
     * @return array|RedirectResponse
     *
     * @Security("is_granted('ROLE_CONTENT_ADMIN')")
     * @Route("/new_popup", name="digital_copy_holder_new_popup", methods={"GET", "POST"})")
     *
     * @Template
     */
    public function newPopupAction(Request $request) {
        return $this->newAction($request);
    }

    /**
     * Finds and displays a DigitalCopyHolder entity.
     *
     * @return array
     *
     * @Route("/{id}", name="digital_copy_holder_show", methods={"GET"})")
     *
     * @Template
     */
    public function showAction(DigitalCopyHolder $digitalCopyHolder) {
        return [
            'digitalCopyHolder' => $digitalCopyHolder,
        ];
    }

    /**
     * Displays a form to edit an existing DigitalCopyHolder entity.
     *
     * @return array|RedirectResponse
     *
     * @Security("is_granted('ROLE_CONTENT_ADMIN')")
     * @Route("/{id}/edit", name="digital_copy_holder_edit", methods={"GET", "POST"})")
     *
     * @Template
     */
    public function editAction(Request $request, DigitalCopyHolder $digitalCopyHolder, EntityManagerInterface $em) {
        $editForm = $this->createForm(DigitalCopyHolderType::class, $digitalCopyHolder);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em->flush();
            $this->addFlash('success', 'The digitalCopyHolder has been updated.');

            return $this->redirectToRoute('digital_copy_holder_show', ['id' => $digitalCopyHolder->getId()]);
        }

        return [
            'digitalCopyHolder' => $digitalCopyHolder,
            'edit_form' => $editForm->createView(),
        ];
    }

    /**
     * Deletes a DigitalCopyHolder entity.
     *
     * @return array|RedirectResponse
     *
     * @Security("is_granted('ROLE_CONTENT_ADMIN')")
     * @Route("/{id}/delete", name="digital_copy_holder_delete", methods={"GET"})")
     */
    public function deleteAction(Request $request, DigitalCopyHolder $digitalCopyHolder, EntityManagerInterface $em) {
        $em->remove($digitalCopyHolder);
        $em->flush();
        $this->addFlash('success', 'The digitalCopyHolder was deleted.');

        return $this->redirectToRoute('digital_copy_holder_index');
    }
}
