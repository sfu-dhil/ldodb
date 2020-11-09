<?php

declare(strict_types=1);

/*
 * (c) 2020 Michael Joyce <mjoyce@sfu.ca>
 * This source file is subject to the GPL v2, bundled
 * with this source code in the file LICENSE.
 */

namespace App\Controller;

use App\Entity\Entity;
use App\Repository\EntityRepository;
use Knp\Bundle\PaginatorBundle\Definition\PaginatorAwareInterface;
use Nines\UtilBundle\Controller\PaginatorTrait;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Entity controller.
 *
 * @Route("/entity")
 */
class EntityController extends AbstractController implements PaginatorAwareInterface {
    use PaginatorTrait;

    /**
     * Typeahead API endpoint for Book entities.
     *
     * @Route("/typeahead", name="entity_typeahead", methods={"GET"})")
     *
     * @return JsonResponse
     */
    public function typeahead(Request $request, EntityRepository $repo) {
        $q = $request->query->get('q');
        if ( ! $q) {
            return new JsonResponse([]);
        }
        $data = [];
        foreach ($repo->typeaheadQuery($q) as $result) {
            $data[] = [
                'id' => $result->getId(),
                'text' => sprintf('(%s) %s', $result->getType(), $result),
            ];
        }

        return new JsonResponse($data);
    }
}
