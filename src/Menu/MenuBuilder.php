<?php

namespace App\Menu;

use App\Entity\Asc\Parc;
use App\Service\ConteneurService;
use App\Service\Cache\ParcCacheService;
use Knp\Menu\FactoryInterface;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\Security\Core\Security;

class MenuBuilder
{
    private $_factory;
    private $_parcCacheService;
    private $_security;
    private $_conteneurService;

    public function __construct(FactoryInterface $factory, ParcCacheService $parcCacheService, Security $security, ConteneurService $conteneurService)
    {
        $this->_factory = $factory;
        $this->_parcCacheService = $parcCacheService;
        $this->_security = $security;
        $this->_conteneurService = $conteneurService;
    }

    /**
     * Function createMainMenu
     *
     * @return void
     */
    public function createMainMenu(RequestStack $requestStack)
    {
        $menu = $this->_factory->createItem('root');
        $menu->setChildrenAttribute('class', 'navbar-nav');
        //$parcs = $this->_parcCacheService->findAllFromParcCache();
        $parc = $requestStack->getCurrentRequest()->get('parc');
        if (!$parc)
            $parcID = 0;
        else
            $parcID = $parc->getId();
        $menu->addChild(
            'Tableau de bord',
            [
                'route' => 'app_statistique',
                'routeParameters' => [
                    'parc' =>   $parcID
                ]
            ]
        )
            ->setAttribute('class', 'nav-item dropdown')
            ->setLinkAttributes(
                [
                    'class' => 'nav-link dropdown-toggle arrow-none',
                    'id' => 'topnav-topnav-statistiques',
                    /*         'data-toggle' => 'dropdown', */
                    'aria-haspopup' => 'true',
                    'aria-expanded' => 'false',
                    'role' => 'button',
                ]
            )
            ->setLabel('<i class="fe-anchor mr-1"></i> Tableau de bord '/* <div class="arrow-down"></div> */)
            ->setExtra('safe_label', true);
        if ($parc) {
            $menu->addChild(
                'Etat Actuel Prod',
                [
                    'route' => 'app_etat_actuel_prod',
                    'routeParameters' => [
                        'parc' =>   $parcID
                    ]
                ]
            )
                ->setAttribute('class', 'nav-item dropdown')
                ->setLinkAttributes(
                    [
                        'class' => 'nav-link dropdown-toggle arrow-none',
                        'id' => 'topnav-etat-actuel-prod',
                        /*'data-toggle' => 'dropdown', */
                        'aria-haspopup' => 'true',
                        'aria-expanded' => 'false',
                        'role' => 'button',
                    ]
                )
                ->setLabel('<i class="fe-map mr-1"></i> Etat Actuel Prod '/* <div class="arrow-down"></div> */)
                ->setExtra('safe_label', true);
        }
        $conteneurs = $this->_conteneurService->getContainerList();
        $subMenuEtatMAEActuelProd = function ($conteneur) {
            if ($conteneur != 'Poche')
                return ['MAE ' . $conteneur . 's', 'app_default', 'dropdown-item', null];
        };
        if ($parc) {
            $menu->addChild('Prod à faire')
                ->setAttribute('class', 'nav-item dropdown')
                ->setUri("#")
                ->setLinkAttributes(
                    [
                        'class' => 'nav-link dropdown-toggle arrow-none',
                        'id' => 'topnav-prod_a_faire',
                        'data-toggle' => 'dropdown',
                        'aria-haspopup' => 'true',
                        'aria-expanded' => 'false',
                        'role' => 'button',
                    ]
                )
                ->setLabel('<i class="fe-clipboard mr-1"></i> Prod à faire <div class="arrow-down"></div>')
                ->setExtra('safe_label', true)->setChildrenAttributes(
                    [
                        'class' => 'dropdown-menu',
                        'aria-labelledby' => 'topnav-topnav-prod_a_faire'
                    ]
                );

            foreach (
                array_merge(
                    [
                        ['Préparation Corde', 'app_preparation_corde', 'dropdown-item', null],
                        ['Préparation Lanterne', 'app_preparation_lanterne', 'dropdown-item', null],
                        ['Préparation Poche', 'app_preparation_poche', 'dropdown-item', null],
                        ['Assemblage', 'app_assemblage', 'dropdown-item', null]
                    ],
                    array_filter(array_map($subMenuEtatMAEActuelProd, $conteneurs)),
                    [
                        ['MAE Assemblages', 'app_mise_a_eau', 'dropdown-item', null],
                        ['MAE Poches', 'app_mise_a_eau', 'dropdown-item', null],
                        ['Passage Chaussettes', 'app_chaussement', 'dropdown-item', null],
                        ['Retrait Transfert', 'app_retrait', 'dropdown-item', null],
                        ['Retrait AW Lanternes', 'app_retrait', 'dropdown-item', null],
                        ['Retrait AW Cordes', 'app_retrait', 'dropdown-item', null],
                        ['Traitement Comercial', 'app_commerciale', 'dropdown-item', null]

                    ]
                ) as $item
            ) {
                $menu['Prod à faire']->addChild($item[0], [
                    'route' => $item[1],
                    'routeParameters' => [
                        'parc' =>   $parcID
                    ]
                ])->setLinkAttribute('class', $item[2]);
            }

            $menu->addChild(
                'Alertes de travail',
                [
                    'route' => 'app_alertes_de_travail',
                    'routeParameters' => ['parc' =>  $parcID]
                ]
            )->setAttribute('class', 'nav-item dropdown')
                ->setLinkAttributes(
                    [
                        'class' => 'nav-link dropdown-toggle arrow-none',
                        'id' => 'topnav-alertes-de-travail',
                        /*         'data-toggle' => 'dropdown', */
                        'aria-haspopup' => 'true',
                        'aria-expanded' => 'false',
                        'role' => 'button',
                    ]
                )
                ->setLabel('<i class="fe-alert-triangle mr-1"></i> Alertes de travail '/* <div class="arrow-down"></div> */)
                ->setExtra('safe_label', true);

            $menu->addChild(
                'Prod par cycle',
                [
                    'route' => 'app_prod_par_cycle',
                    /* 'routeParameters' => [
                    'parc' =>   $parcID
                ] */
                ]
            )
                ->setAttribute('class', 'nav-item dropdown')
                ->setLinkAttributes(
                    [
                        'class' => 'nav-link dropdown-toggle arrow-none',
                        'id' => 'topnav-prod-par-cycle',
                        /*         'data-toggle' => 'dropdown', */
                        'aria-haspopup' => 'true',
                        'aria-expanded' => 'false',
                        'role' => 'button',
                    ]
                )
                ->setLabel('<i class="fe-clock mr-1"></i> Prod par cycle '/* <div class="arrow-down"></div> */)
                ->setExtra('safe_label', true);
        }

        $this->addDropdownMenuItem(
            $menu,
            'Outils de gestion',
            'topnav-outils-de-gestion',
            'fe-bar-chart-2',
            [
                ['Historique des opérations', 'app_historique', 'dropdown-item',   $parcID],
                ['Détail tâches effectuées', 'app_historique', 'dropdown-item',   $parcID],
                ['Prévisions des sorties', 'app_prevision', 'dropdown-item',   $parcID],
            ]
        );

        return $menu;
    }
    private function addDropdownMenuItem($menu, $label, $linkId, $iconClass, $dropdownItems)
    {
        $menu->addChild($label)
            ->setAttribute('class', 'nav-item dropdown')
            ->setUri("#")
            ->setLinkAttributes(
                [
                    'class' => 'nav-link dropdown-toggle arrow-none',
                    'id' => 'topnav-' . $linkId,
                    'data-toggle' => 'dropdown',
                    'aria-haspopup' => 'true',
                    'aria-expanded' => 'false',
                    'role' => 'button',
                ]
            )
            ->setLabel('<i class="' . $iconClass . ' mr-1"></i> ' . $label . ' <div class="arrow-down"></div>')
            ->setExtra('safe_label', true);

        if (!empty($dropdownItems)) {
            $menu[$label]->setChildrenAttributes(
                [
                    'class' => 'dropdown-menu',
                    'aria-labelledby' => 'topnav-' . $linkId
                ]
            );

            foreach ($dropdownItems as $item) {
                $menu[$label]->addChild($item[0], [
                    'route' => $item[1],
                    'routeParameters' => ['parc' =>  $item[3]]
                ])->setLinkAttribute('class', $item[2]);
            }
        }
    }
}
