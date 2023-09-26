<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Service\SegmentService;

class SegmentController extends AbstractController
{
    
    /**
     * @Route("/get_segments_by_filiere/{id}", name="get_segments_by_filiere")
     */
    public function getSegmentsByFiliere($id, SegmentService $segmentService)
    {
        // Récupérer les segments de la filière avec l'id spécifié (remplacez cette partie par votre logique)
        $segments = $segmentService->getSegments($id);

        // Retourner les données au format JSON
        return new JsonResponse($segments);
    }
}
