<?php

namespace App\Service;

use App\Repository\ProcessusRepository;

class ExcelAgeService
{
    private ProcessusRepository $processusRepository;

    public function __construct(ProcessusRepository $processusRepository)
    {
        $this->processusRepository = $processusRepository;
    }

    public function getAgesFromExcel(): array
    {
        // Return ages from Processus fixtures loaded from Excel data
        $processus = $this->processusRepository->findAll();
        $ages = [];
        foreach ($processus as $proc) {
            if ($proc->getAge() !== null) {
                $ages[] = $proc->getAge();
            }
        }
        return $ages;
    }
}
