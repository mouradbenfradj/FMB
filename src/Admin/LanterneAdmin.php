<?php

declare(strict_types=1);

namespace App\Admin;

use App\Entity\Parc;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

final class LanterneAdmin extends AbstractAdmin
{
    protected function configureDatagridFilters(DatagridMapper $filter): void
    {
        $filter
            ->add('id')
            ->add('parc')
            ->add('nomLanterne')
            ->add('nbrPoche')
            ->add('nbrEnStock')
        ;
    }

    protected function configureListFields(ListMapper $list): void
    {
        $list
            ->addIdentifier('id')
            ->add('parc')
            ->add('nomLanterne')
            ->add('nbrPoche')
            ->add('nbrEnStock')
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
        $form->add('parc', EntityType::class, [
            'class' => Parc::class,
            'choice_label' => 'libParc',
        ])->add('nomLanterne')
            ->add('nbrPoche')
            ->add('nbrEnStock')
        ;
    }

    protected function configureShowFields(ShowMapper $show): void
    {
        $show
            ->add('id')
            ->add('parc')
            ->add('nomLanterne')
            ->add('nbrPoche')
            ->add('nbrEnStock')
        ;
    }
}
