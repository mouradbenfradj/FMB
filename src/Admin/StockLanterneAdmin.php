<?php

declare(strict_types=1);

namespace App\Admin;

use App\Entity\Emplacement;
use App\Entity\Lanterne;
use App\Entity\StockArticleSn;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\DateType;

final class StockLanterneAdmin extends AbstractAdmin
{
    protected function configureDatagridFilters(DatagridMapper $filter): void
    {
        $filter
            ->add('id')
            ->add('datedecreation')
            ->add('lanterne')
            ->add('stockArticleSn')
            ->add('emplacement')
            ->add('pret')
            ->add('datederetirement')
            ->add('datederetraittransfert')
            ->add('datedemaetransfert')
            ->add('dateDeMiseAEau')
        ;
    }

    protected function configureListFields(ListMapper $list): void
    {
        $list
            ->add('id')
            ->add('datedecreation')
            ->add('lanterne', EntityType::class, [
                'class' => Lanterne::class,
                'choice_label' => 'nomLanterne',
            ])
            ->add('stockArticleSn', EntityType::class, [
                'class' => StockArticleSn::class,
                'choice_label' => 'numeroSerie',
            ])
            ->add('emplacement', EntityType::class, [
                'class' => Emplacement::class,
                'choice_label' => 'nomEmplacement',
            ])
            ->add('pret')
            ->add('datederetirement')
            ->add('datederetraittransfert')
            ->add('datedemaetransfert')
            ->add('dateDeMiseAEau')
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
            ->add('datedecreation', DateType::class, [
                'widget' => 'single_text',
                'required' => false,
            ])
            ->add('lanterne', EntityType::class, [
                'class' => Lanterne::class,
                'choice_label' => 'nomLanterne',
            ])
            ->add('stockArticleSn', EntityType::class, [
                'class' => StockArticleSn::class,
                'choice_label' => 'numeroSerie',
            ])
            ->add('emplacement', EntityType::class, [
                'class' => Emplacement::class,
                'choice_label' => 'nomEmplacement',
                'required' => false,
            ])
            ->add('pret')
            ->add('datederetirement', DateType::class, [
                'widget' => 'single_text',
                'required' => false,
            ])
            ->add('datederetraittransfert', DateType::class, [
                'widget' => 'single_text',
                'required' => false,
            ])
            ->add('datedemaetransfert', DateType::class, [
                'widget' => 'single_text',
                'required' => false,
            ])
            ->add('dateDeMiseAEau', DateType::class, [
                'widget' => 'single_text',
                'required' => false,
            ])
        ;
    }

    protected function configureShowFields(ShowMapper $show): void
    {
        $show
            ->add('id')
            ->add('datedecreation')
            ->add('lanterne', EntityType::class, [
                'class' => Lanterne::class,
                'choice_label' => 'nomLanterne',
            ])
            ->add('stockArticleSn', EntityType::class, [
                'class' => StockArticleSn::class,
                'choice_label' => 'numeroSerie',
            ])
            ->add('emplacement', EntityType::class, [
                'class' => Emplacement::class,
                'choice_label' => 'nomEmplacement',
            ])
            ->add('pret')
            ->add('datederetirement')
            ->add('datederetraittransfert')
            ->add('datedemaetransfert')
            ->add('dateDeMiseAEau')
        ;
    }
}
