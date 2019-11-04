<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Entity;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

/**
 * Entity controller.
 *
 * @Route("/entity")
 */
class EntityController extends Controller {

    /**
     * Typeahead API endpoint for Book entities.
     *
     * @param Request $request
     *
     * @Route("/typeahead", name="entity_typeahead", methods={"GET"})")
     *
     * @return JsonResponse
     */
    public function typeahead(Request $request) {
        $q = $request->query->get('q');
        if (!$q) {
            return new JsonResponse([]);
        }
        $em = $this->getDoctrine()->getManager();
        $repo = $em->getRepository(Entity::class);
        $data = [];
        foreach ($repo->typeaheadQuery($q) as $result) {
            $data[] = [
                'id' => $result->getId(),
                'text' => sprintf("(%s) %s", $result->getType(), $result)
            ];
        }
        return new JsonResponse($data);
    }

}
