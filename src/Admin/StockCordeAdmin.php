<?php

declare(strict_types=1);

namespace App\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;

final class StockCordeAdmin extends AbstractAdmin
{
    protected function configureDatagridFilters(DatagridMapper $filter): void
    {
        $filter
            ->add('id')
            ->add('quantiter')
            ->add('poid')
            ->add('longeur')
        ;
    }

    protected function configureListFields(ListMapper $list): void
    {
        $list
            ->add('id')
            ->add('quantiter')
            ->add('poid')
            ->add('longeur')
            ->add('emplacement')
            ->add('corde')
            ->add('stockArticleSn')
            ->add('pret')
            ->add('datedecreation')
            ->add('datederetirement')
            ->add('datederetraittransfert')
            ->add('datedemaetransfert')
            ->add('dateDeMiseAEau')
            ->add('chaussement')
            ->add('dateassemblage')
            ->add('datechaussement')
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
            ->add('quantiter')
            ->add('poid')
            ->add('longeur')
        ;
    }

    protected function configureShowFields(ShowMapper $show): void
    {
        $show
            ->add('id')
            ->add('quantiter')
            ->add('poid')
            ->add('longeur')
        ;
    }
}
