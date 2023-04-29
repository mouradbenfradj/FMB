<?php

namespace App\Controller\Menu\Statistique;

use App\Repository\MagasinsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
 /**
     * @Route("/statistique")
     */
class StatistiqueController extends AbstractController
{
    /**
     * @Route("/", name="app_statistique")
     */
    public function index(
        Request $request,
        MagasinsRepository $magasinsRepository
        )
    {
        if ($request->get('idparc') == null) {
            $parc = $magasinsRepository->findAll();
            $nbfiliere = $magasinsRepository->countTotaleNbrFiliere();
            $nbCordeP = $magasinsRepository->countTotaleNbrCordePreparer();
            $nbCordeHuitreP = $magasinsRepository->countTotaleNbrCordeHuitrePreparer();
            $nbCordeMouleP = $magasinsRepository->countTotaleNbrCordeMoulePreparer();
            $nbCordeAs = $magasinsRepository->countTotaleNbrCordeAssemble();
            $nbCordeAe = $magasinsRepository->countTotaleNbrCordeAEau();
            $nbCordeHuitreAe = $magasinsRepository->countTotaleNbrCordeHuitreAEau();
            $nbCordeMouleAe = $magasinsRepository->countTotaleNbrCordeHMoulesAEau();

            $nbCordeChausser = $magasinsRepository->countTotaleNbrCordeChausseeAE();
            $nbCordeAsAe = $magasinsRepository->countTotaleNbrCordeAssembleAEau();
            $nbCordeES = $magasinsRepository->countTotaleNbrCordeEnStock();
            $nbCorde = $nbCordeP + $nbCordeAe + $nbCordeES + $nbCordeAs + $nbCordeAsAe;

            $nbLanterneP = $magasinsRepository->countTotaleNbrLanternePreparer();
            $nbLanterneAe = $magasinsRepository->countTotaleNbrLanterneAEau();
            $nbrlanterneChausser = $magasinsRepository->countTotaleNbrLanterneChausserAEau();
            $nbLanterneES = $magasinsRepository->countTotaleNbrLanterneEnStock();
            $nbLanterne = $nbLanterneP + $nbLanterneAe + $nbLanterneES;

            $nbPocheP = $magasinsRepository->countTotaleNbrPochePreparer();
            $nbPocheAsP = $magasinsRepository->countTotaleNbrPocheAssemblePreparer();
            $nbPocheAe = $magasinsRepository->countTotaleNbrPocheAEau();
            $nbPocheChausserAe = $magasinsRepository->countTotaleNbrPocheChausserAEau();
            $nbPocheAsAe = $magasinsRepository->countTotaleNbrPocheAssembleAEau();
            $nbPocheES = $magasinsRepository->countTotaleNbrPocheEnStock();
            $nbPoche = $nbPocheP + $nbPocheAe + $nbPocheES;
        } else {
            $parc = $magasinsRepository->findOneByIdMagasin($request->get('idparc'));
            $nbfiliere = $magasinsRepository->countTotaleNbrFiliereByParc($parc);
            $nbCordeP = $magasinsRepository->countTotaleNbrCordePreparerByParc($parc);
            $nbCordeHuitreP = $magasinsRepository->countTotaleNbrCordeHuitrePreparerByParc($parc);
            $nbCordeMouleP = $magasinsRepository->countTotaleNbrCordeMoulePreparerByParc($parc);
            $nbCordeAs = $magasinsRepository->countTotaleNbrCordeAssembleByParc($parc);
            $nbCordeAe = $magasinsRepository->countTotaleNbrCordeAEauByParc($parc);
            $nbCordeHuitreAe = $magasinsRepository->countTotaleNbrCordeHuitreAEauByParc($parc);
            $nbCordeMouleAe = $magasinsRepository->countTotaleNbrCordeMouleAEauByParc($parc);
            $nbCordeChausser = $magasinsRepository->countTotaleNbrCordeChausserAEByParc($parc);

            $nbCordeAsAe = $magasinsRepository->countTotaleNbrCordeAssembleAEauByParc($parc);
            $nbCordeES = $magasinsRepository->countTotaleNbrCordeEnStockByParc($parc);
            $nbCorde = $nbCordeP + $nbCordeAe + $nbCordeES;

            $nbLanterneP = $magasinsRepository->countTotaleNbrLanternePreparerByParc($parc);
            $nbLanterneAe = $magasinsRepository->countTotaleNbrLanterneAEauByParc($parc);
            $nbrlanterneChausser = $magasinsRepository->countTotaleNbrLanterneChausserAEauByParc($parc);
            $nbLanterneES = $magasinsRepository->countTotaleNbrLanterneEnStockByParc($parc);
            $nbLanterne = $nbLanterneP + $nbLanterneAe + $nbLanterneES;

            $nbPocheP = $magasinsRepository->countTotaleNbrPochePreparerByParc($parc);
            $nbPocheAsP = $magasinsRepository->countTotaleNbrPocheAssemblePreparerByParc($parc);
            $nbPocheAe = $magasinsRepository->countTotaleNbrPocheAEauByParc($parc);
            $nbPocheChausserAe = $magasinsRepository->countTotaleNbrPocheChausserAEauByParc($parc);
            $nbPocheAsAe = $magasinsRepository->countTotaleNbrPocheAssembleAEauByParc($parc);
            $nbPocheES = $magasinsRepository->countTotaleNbrPocheEnStockByParc($parc);
            $nbPoche = $nbPocheP + $nbPocheAe + $nbPocheES + $nbPocheAsP + $nbPocheAsAe;
        }
        return $this->render('default/index.html.twig',
            array(
                'entity' => $parc,
                'nbrParc' => count($parc),
                'nbrcorde' => ($nbCorde),
                'nbrcordev' => ($nbCordeES),
                'nbrCordeAs' => ($nbCordeAs),
                'nbrCordeAsAe' => ($nbCordeAsAe),
                'nbrCordeChausser' => $nbCordeChausser,
                'nbrcordep' => ($nbCordeP),
                'nbCordeHuitreP' => ($nbCordeHuitreP),
                'nbCordeMouleP' => ($nbCordeMouleP),
                'nbrcordeae' => ($nbCordeAe),
                'nbrordehuitreae' => ($nbCordeHuitreAe),
                'nbcordemouleae' => ($nbCordeMouleAe),
                'nbrlanterne' => ($nbLanterne),
                'nbrlanternev' => ($nbLanterneES),
                'nbrlanternep' => ($nbLanterneP),
                'nbrlanterneae' => ($nbLanterneAe),
                'nbrlanterneChausser' => $nbrlanterneChausser,
                'nbrpoche' => ($nbPoche),
                'nbrpochev' => ($nbPocheES),
                'nbrpochep' => ($nbPocheP),
                'nbrpocheAsp' => ($nbPocheAsP),
                'nbrpocheae' => ($nbPocheAe),
                'nbrpocheAsae' => ($nbPocheAsAe),
                'nbPocheChausserAe' => $nbPocheChausserAe,
                'nbrfiliere' => $nbfiliere
            )
        );
    }
}