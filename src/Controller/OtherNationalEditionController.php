<?php

declare(strict_types=1);

/*
 * (c) 2020 Michael Joyce <mjoyce@sfu.ca>
 * This source file is subject to the GPL v2, bundled
 * with this source code in the file LICENSE.
 */

namespace App\Controller;

use App\Entity\OtherNationalEdition;
use App\Form\OtherNationalEditionType;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Bundle\PaginatorBundle\Definition\PaginatorAwareInterface;
use Nines\UtilBundle\Controller\PaginatorTrait;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * OtherNationalEdition controller.
 *
 * @Route("/other_national_edition")
 */
class OtherNationalEditionController extends AbstractController implements PaginatorAwareInterface
{
    use PaginatorTrait;

    /**
     * Lists all OtherNationalEdition entities.
     *
     * @return array
     *
     * @Route("/", name="other_national_edition_index", methods={"GET"})")
     *
     * @Template
     */
    public function indexAction(Request $request, EntityManagerInterface $em) {
        $qb = $em->createQueryBuilder();
        $qb->select('e')->from(OtherNationalEdition::class, 'e')->orderBy('e.id', 'ASC');
        $query = $qb->getQuery();

        $otherNationalEditions = $this->paginator->paginate($query, $request->query->getint('page', 1), 25);

        return [
            'otherNationalEditions' => $otherNationalEditions,
        ];
    }

    /**
     * Creates a new OtherNationalEdition entity.
     *
     * @return array|RedirectResponse
     *
     * @Security("is_granted('ROLE_CONTENT_ADMIN')")
     * @Route("/new", name="other_national_edition_new", methods={"GET", "POST"})")
     *
     * @Template
     */
    public function newAction(Request $request, EntityManagerInterface $em) {
        $otherNationalEdition = new OtherNationalEdition();
        $form = $this->createForm(OtherNationalEditionType::class, $otherNationalEdition);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($otherNationalEdition);
            $em->flush();

            $this->addFlash('success', 'The new otherNationalEdition was created.');

            return $this->redirectToRoute('other_national_edition_show', ['id' => $otherNationalEdition->getId()]);
        }

        return [
            'otherNationalEdition' => $otherNationalEdition,
            'form' => $form->createView(),
        ];
    }

    /**
     * Creates a new OtherNationalEdition entity in a popup.
     *
     * @return array|RedirectResponse
     *
     * @Security("is_granted('ROLE_CONTENT_ADMIN')")
     * @Route("/new_popup", name="other_national_edition_new_popup", methods={"GET", "POST"})")
     *
     * @Template
     */
    public function newPopupAction(Request $request) {
        return $this->newAction($request);
    }

    /**
     * Finds and displays a OtherNationalEdition entity.
     *
     * @return array
     *
     * @Route("/{id}", name="other_national_edition_show", methods={"GET"})")
     *
     * @Template
     */
    public function showAction(OtherNationalEdition $otherNationalEdition) {
        return [
            'otherNationalEdition' => $otherNationalEdition,
        ];
    }

    /**
     * Displays a form to edit an existing OtherNationalEdition entity.
     *
     * @return array|RedirectResponse
     *
     * @Security("is_granted('ROLE_CONTENT_ADMIN')")
     * @Route("/{id}/edit", name="other_national_edition_edit", methods={"GET", "POST"})")
     *
     * @Template
     */
    public function editAction(Request $request, OtherNationalEdition $otherNationalEdition, EntityManagerInterface $em) {
        $editForm = $this->createForm(OtherNationalEditionType::class, $otherNationalEdition);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em->flush();
            $this->addFlash('success', 'The otherNationalEdition has been updated.');

            return $this->redirectToRoute('other_national_edition_show', ['id' => $otherNationalEdition->getId()]);
        }

        return [
            'otherNationalEdition' => $otherNationalEdition,
            'edit_form' => $editForm->createView(),
        ];
    }

    /**
     * Deletes a OtherNationalEdition entity.
     *
     * @return array|RedirectResponse
     *
     * @Security("is_granted('ROLE_CONTENT_ADMIN')")
     * @Route("/{id}/delete", name="other_national_edition_delete", methods={"GET"})")
     */
    public function deleteAction(Request $request, OtherNationalEdition $otherNationalEdition, EntityManagerInterface $em) {
        $em->remove($otherNationalEdition);
        $em->flush();
        $this->addFlash('success', 'The otherNationalEdition was deleted.');

        return $this->redirectToRoute('other_national_edition_index');
    }
}
