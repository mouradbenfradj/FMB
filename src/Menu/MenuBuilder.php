<?php
namespace App\Menu;

use App\Repository\MagasinsRepository;
use Knp\Menu\FactoryInterface;
use Knp\Menu\ItemInterface;
use Symfony\Component\Security\Core\Security;

class MenuBuilder
{
    private $factory;
    private $security;
    private $magasinsRepository;
    /**
     * Add any other dependency you need...
     */
    public function __construct(
        FactoryInterface $factory,
        Security $security,
     MagasinsRepository $magasinsRepository
     )
    {
        $this->factory = $factory;
        $this->security = $security;
        $this->magasinsRepository = $magasinsRepository;
    }

    public function createMainMenu(array $options): ItemInterface
    {
        
        $menu = $this->factory->createItem('root');
        $menu->setChildrenAttribute('class', 'navigation-menu');
        $menu->addChild('Statistiques');
        $menu->addChild('Etat Actuel Prod');
        //if ($this->security->isGranted('ROLE_SUPER_ADMIN')) {
            $menu->addChild('Prod à faire');
        //}
        $menu->addChild('Alertes de travail');
        $menu->addChild('Prod par cycle');
        $menu->addChild('Outils de gestion');
        $menu['Outils de gestion']
        ->addChild('Historique des opérations');
        $menu['Outils de gestion']
        ->addChild('Détail tâches effectées');
		
        $menu['Outils de gestion']
        ->addChild('Prévisions des sorties');

        //if ($this->security->isGranted('ROLE_SUPER_ADMIN')) {
            $menu['Prod à faire']
            ->addChild('Préparation');
            $menu['Prod à faire']
            ->addChild('Assemblage');
            $menu['Prod à faire']
            ->addChild('MAE Lanternes');
            $menu['Prod à faire']
            ->addChild('MAE Cordes');
            $menu['Prod à faire']
            ->addChild('MAE Poches');
            $menu['Prod à faire']
            ->addChild('MAE Assemblages');
            $menu['Prod à faire']
            ->addChild('Passage Chaussettes');
            $menu['Prod à faire']
            ->addChild('Retrait Transfert');
            $menu['Prod à faire']
            ->addChild('Retrait AW Lanternes');
            $menu['Prod à faire']
            ->addChild('Retrait AW Cordes');
            $menu['Prod à faire']
            ->addChild('Traitement Comercial');
            $menu['Prod à faire']['Préparation']
            ->addChild('Préparer Lanternes', array('route' => 'app_preparationlanterne'));
            $menu['Prod à faire']['Préparation']
            ->addChild('Préparer Cordes', array('route' => 'app_preparationcorde'));
            $menu['Prod à faire']['Préparation']
            ->addChild('Préparer Poches', array('route' => 'app_preparationpoche'));
            $menu['Prod à faire']['Assemblage']
            ->addChild('Poches à Cordes', array('route' => 'app_assemblage'));
            $menu['Outils de gestion']['Prévisions des sorties']
            ->addChild('Tableaux', array('route' => 'previsionFuture'));
            $menu['Outils de gestion']['Prévisions des sorties']
            ->addChild('Courbes', array('route' => 'previsionFutureCourbe'));
        //}
        //   $menu->setChildrenAttribute('class', 'nav navbar-nav');
        
        // findMostRecent and Blog are just imaginary examples
        $parcs = $this->magasinsRepository->findAll();
        if ($parcs) {
            foreach ($parcs as $parc) {
                $menu['Statistiques']
                ->addChild($parc->getAbrevMagasin(), array(
                    'route' => 'app_statistique',
                    'routeParameters' => array('idparc' => $parc->getIdMagasin())
                ));
                $menu['Etat Actuel Prod']
                ->addChild($parc->getAbrevMagasin(), array(
                    'route' => 'app_suivi',
                    'routeParameters' => array('idparc' => $parc->getIdMagasin())
                ));
                if ($this->security->isGranted('ROLE_SUPER_ADMIN')) {
                    $menu['Prod à faire']['Passage Chaussettes']
                    ->addChild($parc->getAbrevMagasin(), array(
                        'route' => 'app_chaussement',
                        'routeParameters' => array('idparc' => $parc->getIdMagasin())
                    ));

                    $menu['Prod à faire']["MAE Lanternes"]
                    ->addChild($parc->getAbrevMagasin(), array(
                        'route' => 'app_misaaeaulanterne',
                        'routeParameters' => array('idparc' => $parc->getIdMagasin())
                    ));
                    $menu['Prod à faire']['Retrait AW Lanternes']
                    ->addChild($parc->getAbrevMagasin(), array(
                        'route' => 'app_retraitLanterne',
                        'routeParameters' => array('idparc' => $parc->getIdMagasin())
                    ));
                    $menu['Prod à faire']['Retrait AW Lanternes']->setAttribute('class', 'has-submenu')->setUri("#")->setChildrenAttribute('class', 'submenu');
                    $menu['Prod à faire']["MAE Cordes"]
                    ->addChild($parc->getAbrevMagasin(), array(
                        'route' => 'app_misaaeaucorde',
                        'routeParameters' => array('idparc' => $parc->getIdMagasin())
                    ));
                    $menu['Prod à faire']["MAE Assemblages"]
                    ->addChild($parc->getAbrevMagasin(), array(
                        'route' => 'app_assemblagemiseaeauformulaire',
                        'routeParameters' => array('idparc' => $parc->getIdMagasin())
                    ));
                    $menu['Prod à faire']["MAE Poches"]
                    ->addChild($parc->getAbrevMagasin(), array(
                        'route' => 'app_misaaeaupoche',
                        'routeParameters' => array('idparc' => $parc->getIdMagasin())
                    ));
                    $menu['Prod à faire']['Retrait AW Cordes']
                    ->addChild($parc->getAbrevMagasin(), array(
                        'route' => 'app_retraitcorde',
                        'routeParameters' => array('idparc' => $parc->getIdMagasin())
                    ));
                    $menu['Prod à faire']['Retrait AW Cordes']->setAttribute('class', 'has-submenu')->setUri("#")->setChildrenAttribute('class', 'submenu');
                    $menu['Prod à faire']['Traitement Comercial']
                    ->addChild($parc->getAbrevMagasin(), array(
                        'route' => 'traitementcomerciale',
                        'routeParameters' => array('idparc' => $parc->getIdMagasin())
                    ));
                }
                $menu['Alertes de travail']
                ->addChild($parc->getAbrevMagasin(), array(
                    'route' => 'app_planingdetravaille',
                    'routeParameters' => array('idparc' => $parc->getIdMagasin())
                ));
                $menu['Prod par cycle']
                ->addChild($parc->getAbrevMagasin(), array(
                    'route' => 'app_processusgrocissement',
                    'routeParameters' => array('idparc' => $parc->getIdMagasin())
                ));
                if ($this->security->isGranted('ROLE_SUPER_ADMIN')) {
                    $menu['Prod à faire']['Retrait Transfert']
                    ->addChild($parc->getAbrevMagasin(), array(
                        'route' => 'app_transfert',
                        'routeParameters' => array('idparc' => $parc->getIdMagasin())
                    ));
                }

            }

        }

        $menu['Statistiques']->setAttribute('class', 'has-submenu')->setUri("/")->setChildrenAttribute('class', 'submenu');
        $menu['Etat Actuel Prod']->setAttribute('class', 'has-submenu')->setUri("#")->setChildrenAttribute('class', 'submenu');
        if ($this->security->isGranted('ROLE_SUPER_ADMIN')) {
            $menu['Prod à faire']->setAttribute('class', 'has-submenu')->setUri("#")->setChildrenAttribute('class', 'submenu');
        }
        $menu['Alertes de travail']->setAttribute('class', 'has-submenu')->setUri("#")->setChildrenAttribute('class', 'submenu');
        $menu['Prod par cycle']->setAttribute('class', 'has-submenu')->setUri("#")->setChildrenAttribute('class', 'submenu');
        $menu['Outils de gestion']->setAttribute('class', 'has-submenu')->setUri("#")->setChildrenAttribute('class', 'submenu');
        $menu['Outils de gestion']['Historique des opérations']->setAttribute('class', 'has-submenu')->setUri("/historiqueOperation")->setChildrenAttribute('class', 'submenu');
        $menu['Outils de gestion']['Détail tâches effectées']->setAttribute('class', 'has-submenu')->setUri("/historique")->setChildrenAttribute('class', 'submenu');
        $menu['Outils de gestion']['Prévisions des sorties']->setAttribute('class', 'has-submenu')->setUri("#")->setChildrenAttribute('class', 'submenu');


        if ($this->security->isGranted('ROLE_SUPER_ADMIN')) {
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
        }
        return $menu;
    }

    public function parcMAETransfertMenu(FactoryInterface $factory, array $options)
    {
        $menu = $factory->createItem('root');
        $menu->setChildrenAttribute('class', 'nav navbar-nav');
        $em = $this->container->get('doctrine')->getManager();
        // findMostRecent and Blog are just imaginary examples
        $parcs = $em->getRepository('App\Magasins')->findAll();
        if ($parcs) {
            foreach ($parcs as $parc) {
                $menu->addChild($parc->getAbrevMagasin(), array(
                    'route' => 'app_misaaeautransfert',
                    'routeParameters' => array('idparc' => $parc->getIdMagasin())
                ));
            }
        }
        return $menu;
    }
}