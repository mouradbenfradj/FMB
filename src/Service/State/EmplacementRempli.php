<?php
namespace App\Service\State;

use App\Entity\Asc\Conteneur\Corde;
use App\Entity\Asc\Conteneur\Lanterne;
use App\Entity\Asc\Conteneur\Poche;
use App\Entity\Asc\FiliereComposite\Emplacement;

class EmplacementRempli implements EmplacementStateInterface
{
    public function remplir(Emplacement $emplacement, Corde $corde = null, Lanterne $lanterne = null, Poche $poche = null, \DateTimeInterface $dateRemplissage)
    {
        // Gérez ici le cas où l'emplacement est déjà rempli.
        // Vous pouvez choisir de gérer l'ajout de Corde, Lanterne ou Poche ici.
        
        // Par exemple, vous pouvez choisir de remplacer le contenu existant par le nouveau contenu :
        if ($corde) {
            $emplacement->setCorde($corde);
            $emplacement->setLanterne(null); // Effacer le contenu précédent
            $emplacement->setPoche(null);    // Effacer le contenu précédent
        } elseif ($lanterne) {
            $emplacement->setLanterne($lanterne);
            $emplacement->setCorde(null);     // Effacer le contenu précédent
            $emplacement->setPoche(null);     // Effacer le contenu précédent
        } elseif ($poche) {
            $emplacement->setPoche($poche);
            $emplacement->setCorde(null);     // Effacer le contenu précédent
            $emplacement->setLanterne(null);  // Effacer le contenu précédent
        }
        $emplacement->setDateRemplissage($dateRemplissage);

        
    }
    public function vider(Emplacement $emplacement)
    {
        $emplacement->setCorde(null);
        $emplacement->setLanterne(null);
        $emplacement->setPoche(null);
    }
}
