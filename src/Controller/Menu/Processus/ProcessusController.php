<?php

namespace App\Controller\Menu\Processus;

use App\Entity\Emplacement;
use DateTime;
use App\Implementation\ProcessusImplementation;
use App\Repository\EmplacementRepository;
use App\Repository\MagasinsRepository;
use App\Repository\PhasesRepository;
use App\Repository\ProcessusRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/groscissement")
 */
class ProcessusController  extends AbstractController
{
    
 /**
     * @Route("/", name="app_processusgrocissement")
     */
    public function processgrocissmeent(
        Request $request,
        MagasinsRepository $magasinsRepository,
        PhasesRepository $phasesRepository,
        ProcessusRepository $processusRepository,
        EmplacementRepository $emplacementRepository
        )
    {
        $em = $this->getDoctrine()->getManager();
        $nowDate = new DateTime("now");
        $tableauDesProcessus = array();
        $parc = $magasinsRepository->findOneByIdMagasin($request->get('idparc'));
        $phases = $phasesRepository->findAll();
        $processus = $processusRepository->findAll();
        if ($parc) {
            $processusImplementation = new ProcessusImplementation($em);
            $places = $emplacementRepository->getTotaleEmplacementByParc($parc);
            foreach ($phases as $phase) {
                $tableauDesProcessus[$phase->getId()] = array('nomPhase' => $phase->getNomPhase(), 'processus' => array());
                foreach ($processus as $process) {
                    if ($process->getPhasesProcessus()->getId() == $phase->getId()) {
                        $tableauDesProcessus[$phase->getId()]['processus'][$process->getId()] = array('nomProcessus' => $process->getAbrevProcessus(), 'cycle' => array());
                        foreach ($places as $place) {
                            if ($place->getDateDeRemplissage()) {
                                if ($place->getStockslanterne()) {
                                    if ($place->getStockslanterne()->getProcessus()) {
                                        $cycleArticle = $processusImplementation->cycleArticle($place->getStockslanterne()->getProcessus(), $nowDate, $place->getDateDeRemplissage());
                                        if ($processusImplementation->processusArticle($place->getStockslanterne()->getProcessus(), $nowDate, $place->getDateDeRemplissage())->getId() == $process->getId()) {
                                            if (!isset($tableauDesProcessus[$phase->getId()]['processus'][$process->getId()]['cycle'][$cycleArticle])) {
                                                $tableauDesProcessus[$phase->getId()]['processus'][$process->getId()]['cycle'][$cycleArticle] = array('quantiterLanterne' => 0, 'quantiterCorde' => 0, 'quantiterPoche' => 0, 'nombreLanterne' => 0, 'nombreCorde' => 0, 'nombrePoche' => 0, 'filiere' => array());
                                            }
                                            if (!isset($tableauDesProcessus[$phase->getId()]['processus'][$process->getId()]['cycle'][$cycleArticle]['filiere'][$place->getFlotteur()->getSegment()->getFiliere()->getId()])) {
                                                $tableauDesProcessus[$phase->getId()]['processus'][$process->getId()]['cycle'][$cycleArticle]['filiere'][$place->getFlotteur()->getSegment()->getFiliere()->getId()] = array('nomFiliere' => $place->getFlotteur()->getSegment()->getFiliere()->getNomFiliere(), 'nombreLanterne' => 0, 'nombreCorde' => 0, 'nombrePoche' => 0, 'quantiterLanterne' => 0, 'quantiterCorde' => 0, 'quantiterPoche' => 0, 'segment' => array());
                                            }
                                            if (!isset($tableauDesProcessus[$phase->getId()]['processus'][$process->getId()]['cycle'][$cycleArticle]['filiere'][$place->getFlotteur()->getSegment()->getFiliere()->getId()]['segment'][$place->getFlotteur()->getSegment()->getId()])) {
                                                $tableauDesProcessus[$phase->getId()]['processus'][$process->getId()]['cycle'][$cycleArticle]['filiere'][$place->getFlotteur()->getSegment()->getFiliere()->getId()]['segment'][$place->getFlotteur()->getSegment()->getId()] = array('nomSegment' => $place->getFlotteur()->getSegment()->getNomSegment(), 'nombreLanterne' => 0, 'nombreCorde' => 0, 'nombrePoche' => 0, 'quantiterLanterne' => 0, 'quantiterCorde' => 0, 'quantiterPoche' => 0, 'flotteur' => array());
                                            }
                                            if (!isset($tableauDesProcessus[$phase->getId()]['processus'][$process->getId()]['cycle'][$cycleArticle]['filiere'][$place->getFlotteur()->getSegment()->getFiliere()->getId()]['segment'][$place->getFlotteur()->getSegment()->getId()]['flotteur'][$place->getFlotteur()->getId()])) {
                                                $tableauDesProcessus[$phase->getId()]['processus'][$process->getId()]['cycle'][$cycleArticle]['filiere'][$place->getFlotteur()->getSegment()->getFiliere()->getId()]['segment'][$place->getFlotteur()->getSegment()->getId()]['flotteur'][$place->getFlotteur()->getId()] = array('nomFlotteur' => $place->getFlotteur()->getNomFlotteur(), 'nombreLanterne' => 0, 'nombreCorde' => 0, 'nombrePoche' => 0, 'quantiterLanterne' => 0, 'quantiterCorde' => 0, 'quantiterPoche' => 0, 'emplacement' => array());
                                            }
                                            $tableauDesProcessus[$phase->getId()]['processus'][$process->getId()]['cycle'][$cycleArticle]['filiere'][$place->getFlotteur()->getSegment()->getFiliere()->getId()]['segment'][$place->getFlotteur()->getSegment()->getId()]['flotteur'][$place->getFlotteur()->getId()]['emplacement'][$place->getId()] = $place;
                                            $tableauDesProcessus[$phase->getId()]['processus'][$process->getId()]['cycle'][$cycleArticle]['nombreLanterne'] = $tableauDesProcessus[$phase->getId()]['processus'][$process->getId()]['cycle'][$cycleArticle]['nombreLanterne'] + 1;
                                            $tableauDesProcessus[$phase->getId()]['processus'][$process->getId()]['cycle'][$cycleArticle]['filiere'][$place->getFlotteur()->getSegment()->getFiliere()->getId()]['nombreLanterne'] = $tableauDesProcessus[$phase->getId()]['processus'][$process->getId()]['cycle'][$cycleArticle]['filiere'][$place->getFlotteur()->getSegment()->getFiliere()->getId()]['nombreLanterne'] + 1;
                                            $tableauDesProcessus[$phase->getId()]['processus'][$process->getId()]['cycle'][$cycleArticle]['filiere'][$place->getFlotteur()->getSegment()->getFiliere()->getId()]['segment'][$place->getFlotteur()->getSegment()->getId()]['nombreLanterne'] = $tableauDesProcessus[$phase->getId()]['processus'][$process->getId()]['cycle'][$cycleArticle]['filiere'][$place->getFlotteur()->getSegment()->getFiliere()->getId()]['segment'][$place->getFlotteur()->getSegment()->getId()]['nombreLanterne'] + 1;
                                            $tableauDesProcessus[$phase->getId()]['processus'][$process->getId()]['cycle'][$cycleArticle]['filiere'][$place->getFlotteur()->getSegment()->getFiliere()->getId()]['segment'][$place->getFlotteur()->getSegment()->getId()]['flotteur'][$place->getFlotteur()->getId()]['nombreLanterne'] = $tableauDesProcessus[$phase->getId()]['processus'][$process->getId()]['cycle'][$cycleArticle]['filiere'][$place->getFlotteur()->getSegment()->getFiliere()->getId()]['segment'][$place->getFlotteur()->getSegment()->getId()]['flotteur'][$place->getFlotteur()->getId()]['nombreLanterne'] + 1;
                                            foreach ($place->getStockslanterne()->getPoches() as $poche) {
                                                $tableauDesProcessus[$phase->getId()]['processus'][$process->getId()]['cycle'][$cycleArticle]['quantiterLanterne'] = $tableauDesProcessus[$phase->getId()]['processus'][$process->getId()]['cycle'][$cycleArticle]['quantiterLanterne'] + $poche->getQuantite();
                                                $tableauDesProcessus[$phase->getId()]['processus'][$process->getId()]['cycle'][$cycleArticle]['filiere'][$place->getFlotteur()->getSegment()->getFiliere()->getId()]['quantiterLanterne'] = $tableauDesProcessus[$phase->getId()]['processus'][$process->getId()]['cycle'][$cycleArticle]['filiere'][$place->getFlotteur()->getSegment()->getFiliere()->getId()]['quantiterLanterne'] + $poche->getQuantite();
                                                $tableauDesProcessus[$phase->getId()]['processus'][$process->getId()]['cycle'][$cycleArticle]['filiere'][$place->getFlotteur()->getSegment()->getFiliere()->getId()]['segment'][$place->getFlotteur()->getSegment()->getId()]['quantiterLanterne'] = $tableauDesProcessus[$phase->getId()]['processus'][$process->getId()]['cycle'][$cycleArticle]['filiere'][$place->getFlotteur()->getSegment()->getFiliere()->getId()]['segment'][$place->getFlotteur()->getSegment()->getId()]['quantiterLanterne'] + $poche->getQuantite();
                                                $tableauDesProcessus[$phase->getId()]['processus'][$process->getId()]['cycle'][$cycleArticle]['filiere'][$place->getFlotteur()->getSegment()->getFiliere()->getId()]['segment'][$place->getFlotteur()->getSegment()->getId()]['flotteur'][$place->getFlotteur()->getId()]['quantiterLanterne'] = $tableauDesProcessus[$phase->getId()]['processus'][$process->getId()]['cycle'][$cycleArticle]['filiere'][$place->getFlotteur()->getSegment()->getFiliere()->getId()]['segment'][$place->getFlotteur()->getSegment()->getId()]['flotteur'][$place->getFlotteur()->getId()]['quantiterLanterne'] + $poche->getQuantite();
                                            }
                                        }
                                    }
                                }
                                if ($place->getStockscorde()) {
                                    if ($place->getStockscorde()->getProcessus()) {
                                        if ($processusImplementation->processusArticle($place->getStockscorde()->getProcessus(), $nowDate, $place->getDateDeRemplissage())->getId() == $process->getId()) {
                                            $cycleArticle = $processusImplementation->cycleArticle($place->getStockscorde()->getProcessus(), $nowDate, $place->getDateDeRemplissage());
                                            if (!isset($tableauDesProcessus[$phase->getId()]['processus'][$process->getId()]['cycle'][$cycleArticle])) {
                                                $tableauDesProcessus[$phase->getId()]['processus'][$process->getId()]['cycle'][$cycleArticle] = array('quantiterLanterne' => 0, 'quantiterCorde' => 0, 'quantiterPoche' => 0, 'nombreLanterne' => 0, 'nombreCorde' => 0, 'nombrePoche' => 0, 'filiere' => array());
                                            }
                                            if (!isset($tableauDesProcessus[$phase->getId()]['processus'][$process->getId()]['cycle'][$cycleArticle]['filiere'][$place->getFlotteur()->getSegment()->getFiliere()->getId()])) {
                                                $tableauDesProcessus[$phase->getId()]['processus'][$process->getId()]['cycle'][$cycleArticle]['filiere'][$place->getFlotteur()->getSegment()->getFiliere()->getId()] = array('nomFiliere' => $place->getFlotteur()->getSegment()->getFiliere()->getNomFiliere(), 'nombreLanterne' => 0, 'nombreCorde' => 0, 'nombrePoche' => 0, 'quantiterLanterne' => 0, 'quantiterCorde' => 0, 'quantiterPoche' => 0, 'segment' => array());
                                            }
                                            if (!isset($tableauDesProcessus[$phase->getId()]['processus'][$process->getId()]['cycle'][$cycleArticle]['filiere'][$place->getFlotteur()->getSegment()->getFiliere()->getId()]['segment'][$place->getFlotteur()->getSegment()->getId()])) {
                                                $tableauDesProcessus[$phase->getId()]['processus'][$process->getId()]['cycle'][$cycleArticle]['filiere'][$place->getFlotteur()->getSegment()->getFiliere()->getId()]['segment'][$place->getFlotteur()->getSegment()->getId()] = array('nomSegment' => $place->getFlotteur()->getSegment()->getNomSegment(), 'nombreLanterne' => 0, 'nombreCorde' => 0, 'nombrePoche' => 0, 'quantiterLanterne' => 0, 'quantiterCorde' => 0, 'quantiterPoche' => 0, 'flotteur' => array());
                                            }
                                            if (!isset($tableauDesProcessus[$phase->getId()]['processus'][$process->getId()]['cycle'][$cycleArticle]['filiere'][$place->getFlotteur()->getSegment()->getFiliere()->getId()]['segment'][$place->getFlotteur()->getSegment()->getId()]['flotteur'][$place->getFlotteur()->getId()])) {
                                                $tableauDesProcessus[$phase->getId()]['processus'][$process->getId()]['cycle'][$cycleArticle]['filiere'][$place->getFlotteur()->getSegment()->getFiliere()->getId()]['segment'][$place->getFlotteur()->getSegment()->getId()]['flotteur'][$place->getFlotteur()->getId()] = array('nomFlotteur' => $place->getFlotteur()->getNomFlotteur(), 'nombreLanterne' => 0, 'nombreCorde' => 0, 'nombrePoche' => 0, 'quantiterLanterne' => 0, 'quantiterCorde' => 0, 'quantiterPoche' => 0, 'emplacement' => array());
                                            }
                                            $tableauDesProcessus[$phase->getId()]['processus'][$process->getId()]['cycle'][$cycleArticle]['filiere'][$place->getFlotteur()->getSegment()->getFiliere()->getId()]['segment'][$place->getFlotteur()->getSegment()->getId()]['flotteur'][$place->getFlotteur()->getId()]['emplacement'][$place->getId()] = $place;
                                            $tableauDesProcessus[$phase->getId()]['processus'][$process->getId()]['cycle'][$cycleArticle]['nombreCorde'] = $tableauDesProcessus[$phase->getId()]['processus'][$process->getId()]['cycle'][$cycleArticle]['nombreCorde'] + 1;
                                            $tableauDesProcessus[$phase->getId()]['processus'][$process->getId()]['cycle'][$cycleArticle]['filiere'][$place->getFlotteur()->getSegment()->getFiliere()->getId()]['nombreCorde'] = $tableauDesProcessus[$phase->getId()]['processus'][$process->getId()]['cycle'][$cycleArticle]['filiere'][$place->getFlotteur()->getSegment()->getFiliere()->getId()]['nombreCorde'] + 1;
                                            $tableauDesProcessus[$phase->getId()]['processus'][$process->getId()]['cycle'][$cycleArticle]['filiere'][$place->getFlotteur()->getSegment()->getFiliere()->getId()]['segment'][$place->getFlotteur()->getSegment()->getId()]['nombreCorde'] = $tableauDesProcessus[$phase->getId()]['processus'][$process->getId()]['cycle'][$cycleArticle]['filiere'][$place->getFlotteur()->getSegment()->getFiliere()->getId()]['segment'][$place->getFlotteur()->getSegment()->getId()]['nombreCorde'] + 1;
                                            $tableauDesProcessus[$phase->getId()]['processus'][$process->getId()]['cycle'][$cycleArticle]['filiere'][$place->getFlotteur()->getSegment()->getFiliere()->getId()]['segment'][$place->getFlotteur()->getSegment()->getId()]['flotteur'][$place->getFlotteur()->getId()]['nombreCorde'] = $tableauDesProcessus[$phase->getId()]['processus'][$process->getId()]['cycle'][$cycleArticle]['filiere'][$place->getFlotteur()->getSegment()->getFiliere()->getId()]['segment'][$place->getFlotteur()->getSegment()->getId()]['flotteur'][$place->getFlotteur()->getId()]['nombreCorde'] + 1;
                                            $tableauDesProcessus[$phase->getId()]['processus'][$process->getId()]['cycle'][$cycleArticle]['quantiterCorde'] = $tableauDesProcessus[$phase->getId()]['processus'][$process->getId()]['cycle'][$cycleArticle]['quantiterCorde'] + $place->getStockscorde()->getQuantiter();
                                            $tableauDesProcessus[$phase->getId()]['processus'][$process->getId()]['cycle'][$cycleArticle]['filiere'][$place->getFlotteur()->getSegment()->getFiliere()->getId()]['quantiterCorde'] = $tableauDesProcessus[$phase->getId()]['processus'][$process->getId()]['cycle'][$cycleArticle]['filiere'][$place->getFlotteur()->getSegment()->getFiliere()->getId()]['quantiterCorde'] + $place->getStockscorde()->getQuantiter();
                                            $tableauDesProcessus[$phase->getId()]['processus'][$process->getId()]['cycle'][$cycleArticle]['filiere'][$place->getFlotteur()->getSegment()->getFiliere()->getId()]['segment'][$place->getFlotteur()->getSegment()->getId()]['quantiterCorde'] = $tableauDesProcessus[$phase->getId()]['processus'][$process->getId()]['cycle'][$cycleArticle]['filiere'][$place->getFlotteur()->getSegment()->getFiliere()->getId()]['segment'][$place->getFlotteur()->getSegment()->getId()]['quantiterCorde'] + $place->getStockscorde()->getQuantiter();
                                            $tableauDesProcessus[$phase->getId()]['processus'][$process->getId()]['cycle'][$cycleArticle]['filiere'][$place->getFlotteur()->getSegment()->getFiliere()->getId()]['segment'][$place->getFlotteur()->getSegment()->getId()]['flotteur'][$place->getFlotteur()->getId()]['quantiterCorde'] = $tableauDesProcessus[$phase->getId()]['processus'][$process->getId()]['cycle'][$cycleArticle]['filiere'][$place->getFlotteur()->getSegment()->getFiliere()->getId()]['segment'][$place->getFlotteur()->getSegment()->getId()]['flotteur'][$place->getFlotteur()->getId()]['quantiterCorde'] + $place->getStockscorde()->getQuantiter();
                                        }
                                    }
                                }
                                if ($place->getStockspoches()) {
                                    if ($place->getStockspoches()->getProcessus()) {
                                        if ($processusImplementation->processusArticle($place->getStockspoches()->getProcessus(), $nowDate, $place->getDateDeRemplissage())->getId() == $process->getId()) {
                                            $cycleArticle = $processusImplementation->cycleArticle($place->getStockspoches()->getProcessus(), $nowDate, $place->getDateDeRemplissage());
                                            if (!isset($tableauDesProcessus[$phase->getId()]['processus'][$process->getId()]['cycle'][$cycleArticle])) {
                                                $tableauDesProcessus[$phase->getId()]['processus'][$process->getId()]['cycle'][$cycleArticle] = array('quantiterLanterne' => 0, 'quantiterCorde' => 0, 'quantiterPoche' => 0, 'nombreLanterne' => 0, 'nombreCorde' => 0, 'nombrePoche' => 0, 'filiere' => array());
                                            }
                                            if (!isset($tableauDesProcessus[$phase->getId()]['processus'][$process->getId()]['cycle'][$cycleArticle]['filiere'][$place->getFlotteur()->getSegment()->getFiliere()->getId()])) {
                                                $tableauDesProcessus[$phase->getId()]['processus'][$process->getId()]['cycle'][$cycleArticle]['filiere'][$place->getFlotteur()->getSegment()->getFiliere()->getId()] = array('nomFiliere' => $place->getFlotteur()->getSegment()->getFiliere()->getNomFiliere(), 'nombreLanterne' => 0, 'nombreCorde' => 0, 'nombrePoche' => 0, 'quantiterLanterne' => 0, 'quantiterCorde' => 0, 'quantiterPoche' => 0, 'segment' => array());
                                            }
                                            if (!isset($tableauDesProcessus[$phase->getId()]['processus'][$process->getId()]['cycle'][$cycleArticle]['filiere'][$place->getFlotteur()->getSegment()->getFiliere()->getId()]['segment'][$place->getFlotteur()->getSegment()->getId()])) {
                                                $tableauDesProcessus[$phase->getId()]['processus'][$process->getId()]['cycle'][$cycleArticle]['filiere'][$place->getFlotteur()->getSegment()->getFiliere()->getId()]['segment'][$place->getFlotteur()->getSegment()->getId()] = array('nomSegment' => $place->getFlotteur()->getSegment()->getNomSegment(), 'nombreLanterne' => 0, 'nombreCorde' => 0, 'nombrePoche' => 0, 'quantiterLanterne' => 0, 'quantiterCorde' => 0, 'quantiterPoche' => 0, 'flotteur' => array());
                                            }
                                            if (!isset($tableauDesProcessus[$phase->getId()]['processus'][$process->getId()]['cycle'][$cycleArticle]['filiere'][$place->getFlotteur()->getSegment()->getFiliere()->getId()]['segment'][$place->getFlotteur()->getSegment()->getId()]['flotteur'][$place->getFlotteur()->getId()])) {
                                                $tableauDesProcessus[$phase->getId()]['processus'][$process->getId()]['cycle'][$cycleArticle]['filiere'][$place->getFlotteur()->getSegment()->getFiliere()->getId()]['segment'][$place->getFlotteur()->getSegment()->getId()]['flotteur'][$place->getFlotteur()->getId()] = array('nomFlotteur' => $place->getFlotteur()->getNomFlotteur(), 'nombreLanterne' => 0, 'nombreCorde' => 0, 'nombrePoche' => 0, 'quantiterLanterne' => 0, 'quantiterCorde' => 0, 'quantiterPoche' => 0, 'emplacement' => array());
                                            }
                                            $tableauDesProcessus[$phase->getId()]['processus'][$process->getId()]['cycle'][$cycleArticle]['filiere'][$place->getFlotteur()->getSegment()->getFiliere()->getId()]['segment'][$place->getFlotteur()->getSegment()->getId()]['flotteur'][$place->getFlotteur()->getId()]['emplacement'][$place->getId()] = $place;
                                            $tableauDesProcessus[$phase->getId()]['processus'][$process->getId()]['cycle'][$cycleArticle]['nombrePoche'] = $tableauDesProcessus[$phase->getId()]['processus'][$process->getId()]['cycle'][$cycleArticle]['nombrePoche'] + 1;
                                            $tableauDesProcessus[$phase->getId()]['processus'][$process->getId()]['cycle'][$cycleArticle]['filiere'][$place->getFlotteur()->getSegment()->getFiliere()->getId()]['nombrePoche'] = $tableauDesProcessus[$phase->getId()]['processus'][$process->getId()]['cycle'][$cycleArticle]['filiere'][$place->getFlotteur()->getSegment()->getFiliere()->getId()]['nombrePoche'] + 1;
                                            $tableauDesProcessus[$phase->getId()]['processus'][$process->getId()]['cycle'][$cycleArticle]['filiere'][$place->getFlotteur()->getSegment()->getFiliere()->getId()]['segment'][$place->getFlotteur()->getSegment()->getId()]['nombrePoche'] = $tableauDesProcessus[$phase->getId()]['processus'][$process->getId()]['cycle'][$cycleArticle]['filiere'][$place->getFlotteur()->getSegment()->getFiliere()->getId()]['segment'][$place->getFlotteur()->getSegment()->getId()]['nombrePoche'] + 1;
                                            $tableauDesProcessus[$phase->getId()]['processus'][$process->getId()]['cycle'][$cycleArticle]['filiere'][$place->getFlotteur()->getSegment()->getFiliere()->getId()]['segment'][$place->getFlotteur()->getSegment()->getId()]['flotteur'][$place->getFlotteur()->getId()]['nombrePoche'] = $tableauDesProcessus[$phase->getId()]['processus'][$process->getId()]['cycle'][$cycleArticle]['filiere'][$place->getFlotteur()->getSegment()->getFiliere()->getId()]['segment'][$place->getFlotteur()->getSegment()->getId()]['flotteur'][$place->getFlotteur()->getId()]['nombrePoche'] + 1;
                                            $tableauDesProcessus[$phase->getId()]['processus'][$process->getId()]['cycle'][$cycleArticle]['quantiterPoche'] = $tableauDesProcessus[$phase->getId()]['processus'][$process->getId()]['cycle'][$cycleArticle]['quantiterPoche'] + $place->getStockspoches()->getQuantiter();
                                            $tableauDesProcessus[$phase->getId()]['processus'][$process->getId()]['cycle'][$cycleArticle]['filiere'][$place->getFlotteur()->getSegment()->getFiliere()->getId()]['quantiterPoche'] = $tableauDesProcessus[$phase->getId()]['processus'][$process->getId()]['cycle'][$cycleArticle]['filiere'][$place->getFlotteur()->getSegment()->getFiliere()->getId()]['quantiterPoche'] + $place->getStockspoches()->getQuantiter();
                                            $tableauDesProcessus[$phase->getId()]['processus'][$process->getId()]['cycle'][$cycleArticle]['filiere'][$place->getFlotteur()->getSegment()->getFiliere()->getId()]['segment'][$place->getFlotteur()->getSegment()->getId()]['quantiterPoche'] = $tableauDesProcessus[$phase->getId()]['processus'][$process->getId()]['cycle'][$cycleArticle]['filiere'][$place->getFlotteur()->getSegment()->getFiliere()->getId()]['segment'][$place->getFlotteur()->getSegment()->getId()]['quantiterPoche'] + $place->getStockspoches()->getQuantiter();
                                            $tableauDesProcessus[$phase->getId()]['processus'][$process->getId()]['cycle'][$cycleArticle]['filiere'][$place->getFlotteur()->getSegment()->getFiliere()->getId()]['segment'][$place->getFlotteur()->getSegment()->getId()]['flotteur'][$place->getFlotteur()->getId()]['quantiterPoche'] = $tableauDesProcessus[$phase->getId()]['processus'][$process->getId()]['cycle'][$cycleArticle]['filiere'][$place->getFlotteur()->getSegment()->getFiliere()->getId()]['segment'][$place->getFlotteur()->getSegment()->getId()]['flotteur'][$place->getFlotteur()->getId()]['quantiterPoche'] + $place->getStockspoches()->getQuantiter();
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }
        return $this->render('Default/processusgrocissement.html.twig', array('tableauDesProcessus' => $tableauDesProcessus, 'phases' => $phases, 'processusBase' => $processus, 'entity' => $parc));
    }
}