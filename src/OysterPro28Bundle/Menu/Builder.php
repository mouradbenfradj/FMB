<?php
/**
 * Created by PhpStorm.
 * User: moura
 * Date: 02/11/2017
 * Time: 11:32
 */

namespace OysterPro28Bundle\Menu;


use Knp\Menu\FactoryInterface;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerAwareTrait;

class Builder implements ContainerAwareInterface
{
    use ContainerAwareTrait;

    public function mainMenu(FactoryInterface $factory, array $options)
    {
        $menu = $factory->createItem('root');
        $menu->setChildrenAttribute('class', 'navigation-menu');

        $menu->addChild('Statistique', array('route' => 'oyster_pro28_homepage'));
        $menu->addChild('suivi filières', array('route' => 'oyster_pro28_suivit'));
        $menu->addChild('Operation');

        $menu->addChild('planing de travaille', array('route' => 'oyster_pro28_planing'));
        $menu->addChild('Processus', array('route' => 'oyster_pro28_planing'));
        $menu->addChild('Outil');
        $menu['Outil']->addChild('Historique des operations', array('route' => 'oyster_pro28_planing'));
        $menu['Outil']->addChild('Prévision des sorties', array('route' => 'oyster_pro28_planing'));

        $menu['Operation']->addChild('Préparation', array('route' => 'oyster_pro28_planing'));
        $menu['Operation']->addChild('Assemblage', array('route' => 'oyster_pro28_planing'));
        $menu['Operation']->addChild('MAE', array('route' => 'oyster_pro28_planing'));
        $menu['Operation']->addChild('MAE Assemblage', array('route' => 'oyster_pro28_planing'));
        $menu['Operation']->addChild('Chaussement', array('route' => 'oyster_pro28_planing'));
        $menu['Operation']->addChild('Retrait Transfert', array('route' => 'oyster_pro28_planing'));
        $menu['Operation']->addChild('Retrait AW lanterne', array('route' => 'oyster_pro28_planing'));
        $menu['Operation']->addChild('Retrait AW corde', array('route' => 'oyster_pro28_planing'));
        $menu['Operation']->addChild('Traitement Comercial', array('route' => 'oyster_pro28_planing'));
        $menu['Operation']['Assemblage']->addChild('Poche a corde', array('route' => 'oyster_pro28_planing'));
        $menu['Outil']['Prévision des sorties']->addChild('tableau', array('route' => 'oyster_pro28_planing'));
        $menu['Outil']['Prévision des sorties']->addChild('courbe', array('route' => 'oyster_pro28_planing'));


        $menu['Statistique']->setAttribute('class', 'has-submenu');
        $menu['Operation']->setAttribute('class', 'has-submenu')->setUri("#")->setChildrenAttribute('class', 'submenu');

        $menu['planing de travaille']->setAttribute('class', 'has-submenu')->setUri("#")->setChildrenAttribute('class', 'submenu');
        $menu['Processus']->setAttribute('class', 'has-submenu')->setUri("#")->setChildrenAttribute('class', 'submenu');
        $menu['Outil']->setAttribute('class', 'has-submenu')->setUri("#")->setChildrenAttribute('class', 'submenu');
        $menu['Outil']['Historique des operations']->setAttribute('class', 'has-submenu')->setUri("/app_dev.php/historiqueOperation")->setChildrenAttribute('class', 'submenu');
        $menu['Outil']['Prévision des sorties']->setAttribute('class', 'has-submenu')->setUri("#")->setChildrenAttribute('class', 'submenu');


        $menu['Operation']['Préparation']->setAttribute('class', 'has-submenu')->setUri("#")->setChildrenAttribute('class', 'submenu');
        $menu['Operation']['Assemblage']->setAttribute('class', 'has-submenu')->setUri("#")->setChildrenAttribute('class', 'submenu');
        $menu['Operation']['MAE']->setAttribute('class', 'has-submenu')->setUri("#")->setChildrenAttribute('class', 'submenu');
        $menu['Operation']['MAE Assemblage']->setAttribute('class', 'has-submenu')->setUri("#")->setChildrenAttribute('class', 'submenu');
        $menu['Operation']['Chaussement']->setAttribute('class', 'has-submenu')->setUri("#")->setChildrenAttribute('class', 'submenu');
        $menu['Operation']['Retrait Transfert']->setAttribute('class', 'has-submenu')->setUri("#")->setChildrenAttribute('class', 'submenu');
        $menu['Operation']['Retrait AW lanterne']->setAttribute('class', 'has-submenu')->setUri("#")->setChildrenAttribute('class', 'submenu');
        $menu['Operation']['Retrait AW corde']->setAttribute('class', 'has-submenu')->setUri("#")->setChildrenAttribute('class', 'submenu');
        $menu['Operation']['Traitement Comercial']->setAttribute('class', 'has-submenu')->setUri("#")->setChildrenAttribute('class', 'submenu');

        return $menu;
    }

}