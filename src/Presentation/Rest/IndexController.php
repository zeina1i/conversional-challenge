<?php

namespace App\Presentation\Rest;


use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class IndexController
{
    /**
     * @Route("/", methods={"GET"})
     */
    public function create()
    {
        return new JsonResponse([
            'status' => true,
            'data' => [
                'message' => 'welcome to conversional invoice service'
            ]
        ]);
    }
}