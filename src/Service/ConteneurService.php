<?php

namespace App\Service;

use Symfony\Component\Finder\Finder;

class ConteneurService
{
    public function getContainerList(): array
    {
        $finder = new Finder();
        $finder->files()->in(__DIR__ . '/../Entity/Asc/Conteneur');
        $entityNames = [];

        foreach ($finder as $file) {
            $fileName = pathinfo($file->getRelativePathname(), PATHINFO_FILENAME);
            $entityNames[] = $fileName;
        }
        return $entityNames;
    }
}
