<?php

namespace App\Service\State;

use App\Entity\Asc\Conteneur\Corde;
use App\Entity\Asc\Conteneur\Lanterne;
use App\Entity\Asc\Conteneur\Poche;
use App\Entity\Asc\FiliereComposite\Emplacement;

interface EmplacementStateInterface
{
    public function remplir(Emplacement $emplacement, Corde $corde = null, Lanterne $lanterne = null, Poche $poche = null, \DateTimeInterface $dateRemplissage);

    public function vider(Emplacement $emplacement);
}
