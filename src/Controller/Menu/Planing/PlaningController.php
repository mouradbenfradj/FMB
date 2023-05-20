<?php

namespace App\Controller\Menu\Planing;

use DateTime;
use App\Implementation\PlaningImplementation;
use App\Implementation\ProcessusImplementation;
use App\Repository\EmplacementRepository;
use App\Repository\MagasinsRepository;
use App\Repository\ProcessusRepository;
use App\Repository\StocksCordesRepository;
use App\Repository\StocksLanternesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/planing")
 */
class PlaningController  extends AbstractController
{
    
 /**
     * @Route("/", name="app_planingdetravaille")
     */
    public function planingdetravaille(
        Request $request,
        MagasinsRepository $magasinsRepository,
        ProcessusRepository $processusRepository,
        StocksLanternesRepository $stocksLanternesRepository,
        StocksCordesRepository $stocksCordesRepository,
        EmplacementRepository $emplacementRepository
        )
    {
        $em = $this->getDoctrine()->getManager();
        $nowDate = new DateTime("now");
        $tableAlertProcessus = array();
        $parc = $magasinsRepository->findOneByIdMagasin($request->get('idparc'));
        $processus = $processusRepository->findAll();
        if ($parc) {
            $planingImplementation = new PlaningImplementation();
            $processusImplementation = new ProcessusImplementation();

            $lanternesfabriquer = $stocksLanternesRepository->getLanternePreparerYellowWarning($parc);
            $lanternesfabriquerurgent = $stocksLanternesRepository->getLanternePreparerRedWarning($parc);
            foreach ($lanternesfabriquer as $lanterne) {
                if (!isset($tableAlertProcessus['processus a éfféctuer']['Lanterne Preparé'][$lanterne['nomLanterne']][$lanterne['libArticle']][$lanterne['numeroSerie']][$lanterne['dateDeCreation']->format('Y-m-d')])) {
                    $tableAlertProcessus['processus a éfféctuer']['Lanterne Preparé'][$lanterne['nomLanterne']][$lanterne['libArticle']][$lanterne['numeroSerie']][$lanterne['dateDeCreation']->format('Y-m-d')] = array();
                    $tableAlertProcessus['processus a éfféctuer']['classColor'] = 'bg-warning';
                }
                array_push($tableAlertProcessus['processus a éfféctuer']['Lanterne Preparé'][$lanterne['nomLanterne']][$lanterne['libArticle']][$lanterne['numeroSerie']][$lanterne['dateDeCreation']->format('Y-m-d')], $lanterne['quantiter']);
            }
            foreach ($lanternesfabriquerurgent as $lanterne) {
                if (!isset($tableAlertProcessus['processus urgent']['Lanterne Preparé'][$lanterne['nomLanterne']][$lanterne['libArticle']][$lanterne['numeroSerie']][$lanterne['dateDeCreation']->format('Y-m-d')])) {
                    $tableAlertProcessus['processus urgent']['Lanterne Preparé'][$lanterne['nomLanterne']][$lanterne['libArticle']][$lanterne['numeroSerie']][$lanterne['dateDeCreation']->format('Y-m-d')] = array();
                    $tableAlertProcessus['processus urgent']['classColor'] = 'bg-danger';
                }
                array_push($tableAlertProcessus['processus urgent']['Lanterne Preparé'][$lanterne['nomLanterne']][$lanterne['libArticle']][$lanterne['numeroSerie']][$lanterne['dateDeCreation']->format('Y-m-d')], $lanterne['quantiter']);
            }
            $cordesfabriquer = $stocksCordesRepository->getCordePreparerYellowWarning($parc);
            $cordesfabriquerurgent = $stocksCordesRepository->getCordePreparerRedWarning($parc);
            foreach ($cordesfabriquer as $corde) {
                if (!isset($tableAlertProcessus['processus a éfféctuer']['Corde Preparé'][$corde['nomCorde']][$corde['libArticle']][$corde['numeroSerie']][$corde['dateDeCreation']->format('Y-m-d')])) {
                    $tableAlertProcessus['processus a éfféctuer']['Corde Preparé'][$corde['nomCorde']][$corde['libArticle']][$corde['numeroSerie']][$corde['dateDeCreation']->format('Y-m-d')] = array();
                    $tableAlertProcessus['processus a éfféctuer']['classColor'] = 'bg-warning';
                }
                array_push($tableAlertProcessus['processus a éfféctuer']['Corde Preparé'][$corde['nomCorde']][$corde['libArticle']][$corde['numeroSerie']][$corde['dateDeCreation']->format('Y-m-d')], $corde['quantiter']);

            }

            foreach ($cordesfabriquerurgent as $corde) {
                if (!isset($tableAlertProcessus['processus urgent']['Corde Preparé'][$corde['nomCorde']][$corde['libArticle']][$corde['numeroSerie']][$corde['dateDeCreation']->format('Y-m-d')])) {
                    $tableAlertProcessus['processus urgent']['Corde Preparé'][$corde['nomCorde']][$corde['libArticle']][$corde['numeroSerie']][$corde['dateDeCreation']->format('Y-m-d')] = array();
                    $tableAlertProcessus['processus urgent']['classColor'] = 'bg-danger';
                }
                array_push($tableAlertProcessus['processus urgent']['Corde Preparé'][$corde['nomCorde']][$corde['libArticle']][$corde['numeroSerie']][$corde['dateDeCreation']->format('Y-m-d')], $corde['quantiter']);
            }

            //$places = $emplacementRepository->getTotaleEmplacementByParc($parc);
            $places = $emplacementRepository->getTotaleEmplacementByParc($parc);
            foreach ($places as $place) {
                if ($place->getStockslanterne()) {
                    $stock = $place->getStockslanterne();
                    $conteneur = $place->getStockslanterne()->getLanterne()->getNomLanterne();
                    $quantiter = 0;
                    foreach ($place->getStockslanterne()->getPoches() as $qte) {
                        $quantiter = $quantiter + $qte->getQuantite();
                    }

                } else if ($place->getStockscorde()) {
                    $stock = $place->getStockscorde();
                    $conteneur = $place->getStockscorde()->getCorde()->getNomCorde();
                    $quantiter = $place->getStockscorde()->getQuantiter();
                } else if ($place->getStockspoches()) {
                    $stock = $place->getStockspoches();
                    $conteneur = $place->getStockspoches()->getPoche()->getNomPoche();
                    $quantiter = $place->getStockspoches()->getQuantiter();
                }
                if ($place->getDateDeRemplissage()) {
                    $processusStock = $stock->getProcessus();
                    if ($processusStock) {
                        $processusActuel = $processusImplementation->processusArticle($processusStock, $nowDate, $place->getDateDeRemplissage());
                        $cycleArticle = $processusImplementation->cycleArticle($processusStock, $nowDate, $place->getDateDeRemplissage());
                        $yellowWarning = $planingImplementation->getDateYellowWarning($processusStock, $nowDate, $place->getDateDeRemplissage(), $processus);
                        $redWarning = $planingImplementation->getDateRedWarning($processusStock, $nowDate, $place->getDateDeRemplissage(), $processus);
                        $dateRetrait = $processusImplementation->dateFinProcessus($processusStock, $processusActuel, $place->getDateDeRemplissage(), $processus);
                        $greenFirst = false;
                        $yellowFirst = false;
                        $redFirst = false;
                        if ((($nowDate < $yellowWarning) && ($yellowWarning < $redWarning)) || (($nowDate < $redWarning) && ($yellowWarning > $redWarning)) || ($yellowWarning == $redWarning)) {
                            $greenFirst = true;
                        } elseif (($nowDate < $yellowWarning) && ($nowDate > $redWarning)) {
                            $redFirst = true;
                        } elseif (($nowDate > $yellowWarning) && ($nowDate < $redWarning)) {
                            $yellowFirst = true;
                        } elseif ((($nowDate > $yellowWarning) && ($nowDate > $redWarning)) && ($yellowWarning > $redWarning)) {
                            $yellowFirst = true;
                        } elseif ((($nowDate > $yellowWarning) && ($nowDate > $redWarning)) && ($yellowWarning < $redWarning)) {
                            $redFirst = true;
                        }
                        if ($place->getFlotteur()->getSegment()->getFiliere()->getAireDeTravaille()) {
                            $phaseProcessusPFiliere = $processusActuel->getPhasesProcessus()->getNomPhase() . " Sur l'air de travaille ";
                        } else {
                            $phaseProcessusPFiliere = $processusActuel->getPhasesProcessus()->getNomPhase();
                        }
                        if ($greenFirst) {
                            if (!isset($tableAlertProcessus['processus en cours'][$phaseProcessusPFiliere][$place->getFlotteur()->getSegment()->getFiliere()->getNomFiliere()][$place->getFlotteur()->getSegment()->getNomSegment()][$place->getFlotteur()->getNomFlotteur()][$place->getplace()][$conteneur][$stock->getArticle()->getRefStockArticle()->getRefArticle()->getLibArticle()][$stock->getArticle()->getNumeroSerie()][$place->getDateDeRemplissage()->format('Y-m-d')][$processusActuel->getAbrevProcessus() . '' . $cycleArticle][$dateRetrait->format('Y-m-d')][$quantiter])) {
                                $tableAlertProcessus['processus en cours'][$phaseProcessusPFiliere][$place->getFlotteur()->getSegment()->getFiliere()->getNomFiliere()][$place->getFlotteur()->getSegment()->getNomSegment()][$place->getFlotteur()->getNomFlotteur()][$place->getplace()][$conteneur][$stock->getArticle()->getRefStockArticle()->getRefArticle()->getLibArticle()][$stock->getArticle()->getNumeroSerie()][$place->getDateDeRemplissage()->format('Y-m-d')][$processusActuel->getAbrevProcessus() . '' . $cycleArticle][$dateRetrait->format('Y-m-d')][$quantiter] = array();
                                $tableAlertProcessus['processus en cours']['classColor'] = 'bg-success';
                            }
                            array_push($tableAlertProcessus['processus en cours'][$phaseProcessusPFiliere][$place->getFlotteur()->getSegment()->getFiliere()->getNomFiliere()][$place->getFlotteur()->getSegment()->getNomSegment()][$place->getFlotteur()->getNomFlotteur()][$place->getplace()][$conteneur][$stock->getArticle()->getRefStockArticle()->getRefArticle()->getLibArticle()][$stock->getArticle()->getNumeroSerie()][$place->getDateDeRemplissage()->format('Y-m-d')][$processusActuel->getAbrevProcessus() . '' . $cycleArticle][$dateRetrait->format('Y-m-d')][$quantiter], $quantiter);
                        }
                        if ($yellowFirst) {
                            if (!isset($tableAlertProcessus['processus a éfféctuer'][$phaseProcessusPFiliere][$place->getFlotteur()->getSegment()->getFiliere()->getNomFiliere()][$place->getFlotteur()->getSegment()->getNomSegment()][$place->getFlotteur()->getNomFlotteur()][$place->getplace()][$conteneur][$stock->getArticle()->getRefStockArticle()->getRefArticle()->getLibArticle()][$stock->getArticle()->getNumeroSerie()][$place->getDateDeRemplissage()->format('Y-m-d')][$processusActuel->getAbrevProcessus() . '' . $cycleArticle][$dateRetrait->format('Y-m-d')][$quantiter])) {
                                $tableAlertProcessus['processus a éfféctuer'][$phaseProcessusPFiliere][$place->getFlotteur()->getSegment()->getFiliere()->getNomFiliere()][$place->getFlotteur()->getSegment()->getNomSegment()][$place->getFlotteur()->getNomFlotteur()][$place->getplace()][$conteneur][$stock->getArticle()->getRefStockArticle()->getRefArticle()->getLibArticle()][$stock->getArticle()->getNumeroSerie()][$place->getDateDeRemplissage()->format('Y-m-d')][$processusActuel->getAbrevProcessus() . '' . $cycleArticle][$dateRetrait->format('Y-m-d')][$quantiter] = array();
                                $tableAlertProcessus['processus a éfféctuer']['classColor'] = 'bg-warning';
                            }
                            array_push($tableAlertProcessus['processus a éfféctuer'][$phaseProcessusPFiliere][$place->getFlotteur()->getSegment()->getFiliere()->getNomFiliere()][$place->getFlotteur()->getSegment()->getNomSegment()][$place->getFlotteur()->getNomFlotteur()][$place->getplace()][$conteneur][$stock->getArticle()->getRefStockArticle()->getRefArticle()->getLibArticle()][$stock->getArticle()->getNumeroSerie()][$place->getDateDeRemplissage()->format('Y-m-d')][$processusActuel->getAbrevProcessus() . '' . $cycleArticle][$dateRetrait->format('Y-m-d')][$quantiter], $quantiter);
                        }
                        if ($redFirst) {
                            if (!isset($tableAlertProcessus['processus urgent'][$phaseProcessusPFiliere][$place->getFlotteur()->getSegment()->getFiliere()->getNomFiliere()][$place->getFlotteur()->getSegment()->getNomSegment()][$place->getFlotteur()->getNomFlotteur()][$place->getplace()][$conteneur][$stock->getArticle()->getRefStockArticle()->getRefArticle()->getLibArticle()][$stock->getArticle()->getNumeroSerie()][$place->getDateDeRemplissage()->format('Y-m-d')][$processusActuel->getAbrevProcessus() . '' . $cycleArticle][$dateRetrait->format('Y-m-d')][$quantiter][$quantiter])) {
                                $tableAlertProcessus['processus urgent'][$phaseProcessusPFiliere][$place->getFlotteur()->getSegment()->getFiliere()->getNomFiliere()][$place->getFlotteur()->getSegment()->getNomSegment()][$place->getFlotteur()->getNomFlotteur()][$place->getplace()][$conteneur][$stock->getArticle()->getRefStockArticle()->getRefArticle()->getLibArticle()][$stock->getArticle()->getNumeroSerie()][$place->getDateDeRemplissage()->format('Y-m-d')][$processusActuel->getAbrevProcessus() . '' . $cycleArticle][$dateRetrait->format('Y-m-d')][$quantiter] = array();
                                $tableAlertProcessus['processus urgent']['classColor'] = 'bg-danger';
                            }
                            array_push($tableAlertProcessus['processus urgent'][$phaseProcessusPFiliere][$place->getFlotteur()->getSegment()->getFiliere()->getNomFiliere()][$place->getFlotteur()->getSegment()->getNomSegment()][$place->getFlotteur()->getNomFlotteur()][$place->getplace()][$conteneur][$stock->getArticle()->getRefStockArticle()->getRefArticle()->getLibArticle()][$stock->getArticle()->getNumeroSerie()][$place->getDateDeRemplissage()->format('Y-m-d')][$processusActuel->getAbrevProcessus() . '' . $cycleArticle][$dateRetrait->format('Y-m-d')][$quantiter], $quantiter);
                        }
                    }
                }
            }
        }
        return $this->render('Default/planingdetravaille.html.twig',
            array(
                'entity' => $parc,
                'tableDesProcessus' => $tableAlertProcessus));
    }

}

