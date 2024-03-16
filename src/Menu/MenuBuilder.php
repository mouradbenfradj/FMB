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
        $parcs = $this->_parcCacheService->findAllFromParcCache();
        $menu->addChild('Statistiques', ['route' => 'app_default', 'routeParameters' => ['parcID' => $requestStack->getCurrentRequest()->get('parcID')]])
            ->setAttribute('class', 'nav-item dropdown')
            ->setLinkAttributes(
                [
                    'class' => 'nav-link dropdown-toggle arrow-none',
                    'id' => 'topnav-topnav-statistiques',
                    /*                     'data-toggle' => 'dropdown', */
                    'aria-haspopup' => 'true',
                    'aria-expanded' => 'false',
                    'role' => 'button',
                ]
            )
            ->setLabel('<i class="fe-anchor mr-1"></i> Statistiques '/* <div class="arrow-down"></div> */)
            ->setExtra('safe_label', true);


        $menu->addChild(
            'Etat Actuel Prod',
            [
                'route' => 'app_etat_actuel_prod',
                'routeParameters' => ['parcID' => $requestStack->getCurrentRequest()->get('parcID')]
            ]
        )
            ->setAttribute('class', 'nav-item dropdown')
            ->setLinkAttributes(
                [
                    'class' => 'nav-link dropdown-toggle arrow-none',
                    'id' => 'topnav-etat-actuel-prod',
                    /*                     'data-toggle' => 'dropdown', */
                    'aria-haspopup' => 'true',
                    'aria-expanded' => 'false',
                    'role' => 'button',
                ]
            )
            ->setLabel('<i class="fe-map mr-1"></i> Etat Actuel Prod '/* <div class="arrow-down"></div> */)
            ->setExtra('safe_label', true);
        $conteneurs = $this->_conteneurService->getContainerList();
        $subMenuEtatMAEActuelProd = function ($conteneur) {
            if ($conteneur != 'Poche')
                return ['MAE ' . $conteneur . 's', 'app_default', 'dropdown-item', null];
        };
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
        foreach (array_merge(
            [
                ['Préparation', 'app_preparation', 'dropdown-item', null],
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
        ) as $item) {
            $menu['Prod à faire']->addChild($item[0], [
                'route' => $item[1],
                'routeParameters' => ['parcID' =>  $item[3]]
            ])->setLinkAttribute('class', $item[2]);
        }


        /* $this->addDropdownMenuItem(
            $menu,
            'Etat Actuel Prod',
            'topnav-etat-actuel-prod',
            'fe-map',
            array_map(fn ($parc): array => [$parc->getAbrevParc(), 'app_etat_actuel_prod', 'dropdown-item', $parc->getId()], $parcs),
            /*
            
            $menu['Prod à faire']['Préparation']->setAttribute('class', 'has-submenu')->setUri("#")->setChildrenAttribute('class', 'submenu');
            $menu['Prod à faire']['Assemblage']->setAttribute('class', 'has-submenu')->setUri("#")->setChildrenAttribute('class', 'submenu');
            $menu['Prod à faire']['MAE Lanternes']->setAttribute('class', 'has-submenu')->setUri("#")->setChildrenAttribute('class', 'submenu');
            $menu['Prod à faire']['MAE Cordes']->setAttribute('class', 'has-submenu')->setUri("#")->setChildrenAttribute('class', 'submenu');
            $menu['Prod à faire']['MAE Assemblages']->setAttribute('class', 'has-submenu')->setUri("#")->setChildrenAttribute('class', 'submenu');
            $menu['Prod à faire']['MAE Poches']->setAttribute('class', 'has-submenu')->setUri("#")->setChildrenAttribute('class', 'submenu');
            $menu['Prod à faire']['Passage Chaussettes']->setAttribute('class', 'has-submenu')->setUri("#")->setChildrenAttribute('class', 'submenu');
            $menu['Prod à faire']['Retrait Transfert']->setAttribute('class', 'has-submenu')->setUri("#")->setChildrenAttribute('class', 'submenu');
            $menu['Prod à faire']['Retrait AW Lanternes']->setAttribute('class', 'has-submenu')->setUri("#")->setChildrenAttribute('class', 'submenu');
            $menu['Prod à faire']['Retrait AW Cordes']->setAttribute('class', 'has-submenu')->setUri("#")->setChildrenAttribute('class', 'submenu');
            $menu['Prod à faire']['Traitement Comercial']->setAttribute('class', 'has-submenu')->setUri("#")->setChildrenAttribute('class', 'submenu');
       
            

        ); */


        /* $this->addDropdownMenuItem(
            $menu,
            'Prod à faire',
            'topnav-prod-a-faire',
            'fe-clipboard',
            array_merge(
                [
                    ['Préparation', 'app_default', 'dropdown-item', null],
                    ['Assemblage', 'app_default', 'dropdown-item', null]
                ],
                array_filter(array_map($subMenuEtatMAEActuelProd, $conteneurs)),
                [
                    ['MAE Assemblages', 'app_default', 'dropdown-item', null],
                    ['MAE Poches', 'app_default', 'dropdown-item', null],
                    ['Passage Chaussettes', 'app_default', 'dropdown-item', null],
                    ['Retrait Transfert', 'app_default', 'dropdown-item', null],
                    ['Retrait AW Lanternes', 'app_default', 'dropdown-item', null],
                    ['Retrait AW Cordes', 'app_default', 'dropdown-item', null],
                    ['Traitement Comercial', 'app_default', 'dropdown-item', null]

                ]
            )
        ); */

        $this->addDropdownMenuItem(
            $menu,
            'Alertes de travail',
            'topnav-alertes-de-travail',
            'fe-alert-triangle',
            array_map(fn ($parc): array => [$parc->getAbrevParc(), 'app_default', 'dropdown-item', $parc->getId()], $parcs)
        );

        $this->addDropdownMenuItem(
            $menu,
            'Prod par cycle',
            'topnav-prod-par-cycle',
            'fe-clock',
            array_map(fn ($parc): array => [$parc->getAbrevParc(), 'app_default', 'dropdown-item', $parc->getId()], $parcs)
        );

        $this->addDropdownMenuItem(
            $menu,
            'Outils de gestion',
            'topnav-outils-de-gestion',
            'fe-bar-chart-2',
            [
                ['Historique des opérations', 'app_historique', 'dropdown-item', null],
                ['Détail tâches effectuées', 'app_historique', 'dropdown-item', null],
                ['Prévisions des sorties', 'app_prevision', 'dropdown-item', null],
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
                    'routeParameters' => ['parcID' =>  $item[3]]
                ])->setLinkAttribute('class', $item[2]);
            }
        }
    }
}
