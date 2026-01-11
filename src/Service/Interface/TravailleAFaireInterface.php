<?php

namespace App\Service\Interface;

interface TravailleAFaireInterface
{
    public function preparation(object $materiel);
    public function mae(object $formData, $emplacementsIds, $parc);
    public function retrait(object $materiel);
    public function assemblage(object $materiel);
    public function passageChaussette(object $materiel);
    public function traitementComerciale(object $materiel);
}
