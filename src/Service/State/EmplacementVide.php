<?php
namespace App\Service\State;

use App\Entity\Asc\Conteneur\Corde;
use App\Entity\Asc\Conteneur\Lanterne;
use App\Entity\Asc\Conteneur\Poche;
use App\Entity\Asc\FiliereComposite\Emplacement;

class EmplacementVide implements EmplacementStateInterface
{
    public function remplir(Emplacement $emplacement, Corde $corde = null, Lanterne $lanterne = null, Poche $poche = null, \DateTimeInterface $dateRemplissage)
    {
        if ($corde) {
            $emplacement->setCorde($corde);
        } elseif ($lanterne) {
            $emplacement->setLanterne($lanterne);
        } elseif ($poche) {
            $emplacement->setPoche($poche);
        }
    }
    
    public function vider(Emplacement $emplacement)
    {
        $emplacement->setCorde(null);
        $emplacement->setLanterne(null);
        $emplacement->setPoche(null);
    }
}
