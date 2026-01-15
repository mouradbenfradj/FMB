<?php

namespace App\Controller;

use App\Service\ExcelAgeService;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ExcelAgeController extends AbstractController
{
    #[Route('/excel-ages', name: 'excel_ages')]
    public function index(ExcelAgeService $excelAgeService): Response
    {
        $ages = $excelAgeService->getAgesFromExcel();

        return $this->render('excel_age/index.html.twig', [
            'ages' => $ages,
        ]);
    }
}
