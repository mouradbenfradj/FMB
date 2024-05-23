<?php

namespace App\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\Form\Type\CollectionType;
use Sonata\AdminBundle\Show\ShowMapper;

final class FiliereAdmin extends AbstractAdmin
{

    protected function configureFormFields(FormMapper $form): void
    {
        $form->with('Filiere')->add('parc')->add('nomFiliere')->add('observation')->add('aireDeTravaille')->end()
            ->with('Segments')
            ->add('segments', CollectionType::class, [
                'type_options' => [
                    // Prevents the "Delete" option from being displayed
                    'delete' => true
                ]
            ], [
                'edit' => 'inline',
                'inline' => 'table',
                'sortable' => 'position',
            ])->end();
    }

    protected function configureDatagridFilters(DatagridMapper $datagrid): void
    {
        $datagrid->add('id')->add('nomFiliere')->add('observation')->add('parc')->add('aireDeTravaille')->add('segments');
    }

    protected function configureListFields(ListMapper $list): void
    {
        $list->addIdentifier('id')->add('nomFiliere')->add('observation')->add('parc')->add('aireDeTravaille')->add('segments');
    }

    protected function configureShowFields(ShowMapper $show): void
    {
        $show->add('id')->add('nomFiliere')->add('observation')->add('parc')->add('aireDeTravaille')->add('segments');
    }
}
