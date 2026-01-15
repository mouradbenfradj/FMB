<?php

namespace App\Service\TravailleAFaire;

use App\Service\Materiel\MaterielService;
use App\Service\Interface\TravailleAFaireInterface;

class TravailleAFaireService
{
    private $travailleAFaireInterface;

    public function setStrategy(TravailleAFaireInterface $travailleAFaireInterface)
    {
        $this->travailleAFaireInterface = $travailleAFaireInterface;
    }

    function executePreparation($materielService, $form)
    {
        $materielService->preparation($form);
    }
    /* public function executePreparation($materiel): void
    {
        $result = $this->travailleAFaireInterface->preparation($materiel);
    } */
    public function executeMae($materiel): void
    {
        $result = $this->travailleAFaireInterface->mae($materiel);
    }
    public function executeRetrait($materiel): void
    {
        $result = $this->travailleAFaireInterface->retrait($materiel);
    }
    public function executeAssemblage($materiel): void
    {
        $result = $this->travailleAFaireInterface->assemblage($materiel);
    }
    public function executePassageChaussette($materiel): void
    {
        $result = $this->travailleAFaireInterface->passageChaussette($materiel);
    }
    public function executeTraitementComerciale($materiel): void
    {
        $result = $this->travailleAFaireInterface->traitementComerciale($materiel);
    }
}
