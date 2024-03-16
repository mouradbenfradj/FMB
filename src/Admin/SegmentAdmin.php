<?php

namespace App\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\Form\Type\CollectionType;
use Sonata\AdminBundle\Show\ShowMapper;

final class SegmentAdmin extends AbstractAdmin
{

    protected function configureFormFields(FormMapper $form): void
    {
        $form->with('Segment')->add('nomSegment')->add('longeur')->add('pas')->add('flotteurSegments', CollectionType::class, [
            'type_options' => [
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
        $datagrid->add('id')->add('nomSegment')->add('longeur')->add('pas')->add('filiere')->add('emplacements');
    }

    protected function configureListFields(ListMapper $list): void
    {
        $list->addIdentifier('id')->add('nomSegment')->add('longeur')->add('pas')->add('filiere')->add('emplacements');
    }

    protected function configureShowFields(ShowMapper $show): void
    {
        $show->add('id')->add('nomSegment')->add('longeur')->add('pas')->add('filiere')->add('emplacements');
    }
}