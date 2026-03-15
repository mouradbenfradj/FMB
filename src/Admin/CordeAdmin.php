<?php

declare(strict_types=1);

namespace App\Admin;

use App\Entity\Parc;
use App\Entity\FruitDeMer;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;

final class CordeAdmin extends AbstractAdmin
{
    protected function configureDatagridFilters(DatagridMapper $filter): void
    {
        $filter
            ->add('id')
            ->add('parc.libParc')
            ->add('fruitDeMer', null, [
                'label' => 'ESPECE'
            ])
            ->add('nom', null, [
                'label' => 'NOM CORDE'
            ])
            ->add('quantite', null, [
                'label' => 'QUANTITES'
            ])
            ->add('stockCordes')
        ;
    }

    protected function configureListFields(ListMapper $list): void
    {
        $list
            ->addIdentifier('id')
            ->add('parc', EntityType::class, [
                'class' => Parc::class,
                'choice_label' => 'libParc',
            ])
            ->add('fruitDeMer', EntityType::class, [
                'class' => FruitDeMer::class,
                'choice_label' => 'nom',
                'label' => 'ESPECE'
            ])
            ->add('nom', TextType::class, [
                'label' => 'NOM CORDE'
            ])

            ->add('quantite', IntegerType::class, [
                'label' => 'QUANTITES'
            ])
            ->add(ListMapper::NAME_ACTIONS, null, [
                'actions' => [
                    'show' => [],
                    'edit' => [],
                    'delete' => [],
                ],
            ]);
    }

    protected function configureFormFields(FormMapper $form): void
    {
        $form
            ->add('parc', EntityType::class, [
                'class' => Parc::class,
                'choice_label' => 'libParc',
            ])
            ->add('fruitDeMer', EntityType::class, [
                'class' => FruitDeMer::class,
                'choice_label' => 'nom',
                'label' => 'ESPECE'
            ])
            ->add('nom', TextType::class, [
                'label' => 'NOM CORDE'
            ])
            ->add('quantite', IntegerType::class, [
                'label' => 'QUANTITES'
            ])
            ->add('longeur', NumberType::class);
    }

    protected function configureShowFields(ShowMapper $show): void
    {
        $show
            ->add('id')
            ->add('longeur')
            ->add('fruitDeMer', EntityType::class, [
                'class' => FruitDeMer::class,
                'choice_label' => 'nom',
                'label' => 'ESPECE'
            ])
            ->add('nom', TextType::class, [
                'label' => 'NOM CORDE'
            ])
            ->add('quantite', IntegerType::class, [
                'label' => 'QUANTITES'
            ])

            ->add('parc', EntityType::class, [
                'class' => Parc::class,
                'choice_label' => 'libParc',
            ])
            ->add('stockCordes')
        ;
    }
}
