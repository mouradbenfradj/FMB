<?php

namespace App\EventSubscriber;

use Twig\Environment;
use App\Service\ParcCacheService;
use Symfony\Component\HttpKernel\KernelEvents;
use Symfony\Component\HttpKernel\Event\ControllerEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class ParcTwigGlobalSubscriber implements EventSubscriberInterface
{
    private $twig;
    private $parcCache;

    public function __construct(Environment $twig, ParcCacheService $parcCache)
    {
        $this->twig = $twig;
        $this->parcCache = $parcCache;
    }

    public function onKernelController(ControllerEvent $event): void
    {
        if (!$event->isMainRequest()) {
            return;
        }

        $parcs = $this->parcCache->getAllParcsWithRelations();
        // Définir les variables globales Twig
        $this->twig->addGlobal('parcs', $parcs);

        // Vérifier d'abord dans les attributs de route
        $request = $event->getRequest();
        $routeParams = $event->getRequest()->attributes->get('_route_params', []);

        // Si nous sommes sur une route avec un paramètre parc
        if (isset($routeParams['parc']) && is_numeric($routeParams['parc']) && $routeParams['parc'] != 0) {
            $parc = $this->parcCache->getParcFromCache((int)$routeParams['parc'], $parcs);
            $isAllParcs = false;
        }
        // Sinon, vérifier dans la requête
        else {
            $selectedParcId = $request->query->get('parc');
            if ($selectedParcId && $selectedParcId !== 'all') {
                $parc = $this->parcCache->getParcFromCache((int)$selectedParcId, $parcs);
                $isAllParcs = false;
            } else {
                // Utiliser la méthode statique pour créer l'objet "Tous les parcs"
                $parc = self::createAllParcsObject($parcs);
                $isAllParcs = true;
            }
        }

        // Mettre à jour les variables globales
        $this->twig->addGlobal('parc', $parc);
        $this->twig->addGlobal('isAllParcs', $isAllParcs);

        // Mettre à jour la session pour que les templates (header/aside) affichent
        // correctement l'abréviation du parc sélectionné (ou TOUS)
        try {
            $session = $request->getSession();
            if ($session) {
                $id = method_exists($parc, 'getId') ? $parc->getId() : ($session->get('selected_parc_id', '0'));
                $abrev = method_exists($parc, 'getAbrevParc') ? $parc->getAbrevParc() : ($session->get('current_parc_abrev', 'TOUS'));
                $request->getSession()->set('selected_parc_id', $id);
                $session->set('current_parc_abrev', $abrev);
            }
        } catch (\Exception $e) {
            // Ne pas empêcher la requête en cas d'erreur d'accès à la session
        }
    }

    public static function getSubscribedEvents(): array
    {
        return [
            KernelEvents::CONTROLLER => 'onKernelController',
        ];
    }

    private static function createAllParcsObject(array $parcs): object
    {
        $totals = self::calculateTotals($parcs);

        return new class($totals, count($parcs)) {
            private array $totals;
            private int $parcCount;

            public function __construct(array $totals, int $parcCount)
            {
                $this->totals = $totals;
                $this->parcCount = $parcCount;
            }

            public function getId(): int
            {
                return 0;
            }

            public function getLibParc(): string
            {
                return 'Tous les parcs';
            }

            public function getAbrevParc(): string
            {
                return 'TOUS';
            }

            public function getTotalParcs(): int
            {
                return $this->parcCount;
            }

            public function getTotalFilieres(): int
            {
                return $this->totals['filieres'];
            }

            public function getTotalCordes(): int
            {
                return $this->totals['cordes'];
            }

            public function getTotalStocks(): int
            {
                return $this->totals['stocks'];
            }

            public function getTotalLanternes(): int
            {
                return $this->totals['lanternes'];
            }

            public function getFilieres()
            {
                return new \Doctrine\Common\Collections\ArrayCollection();
            }

            public function getCordes()
            {
                return new \Doctrine\Common\Collections\ArrayCollection();
            }

            public function getStocks()
            {
                return new \Doctrine\Common\Collections\ArrayCollection();
            }

            public function getLanternes()
            {
                return new \Doctrine\Common\Collections\ArrayCollection();
            }
        };
    }

    private static function calculateTotals(array $parcs): array
    {
        $totals = ['filieres' => 0, 'cordes' => 0, 'stocks' => 0, 'lanternes' => 0];

        foreach ($parcs as $parc) {
            $totals['filieres'] += $parc->getFilieres()->count();
            $totals['cordes'] += $parc->getCordes()->count();
            $totals['stocks'] += $parc->getStocks()->count();
            $totals['lanternes'] += $parc->getLanternes()->count();
        }

        return $totals;
    }
}
