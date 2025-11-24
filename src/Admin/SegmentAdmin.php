<?php

namespace App\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;
use Sonata\Form\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

final class SegmentAdmin extends AbstractAdmin
{
    protected function configureFormFields(FormMapper $form): void
    {
        $form->with('Segment')->add('nomSegment', TextType::class)->add('longeur', NumberType::class, ['label' => 'Longeur (m)'])->add('pasEmplacement')->end()->with('Flotteur')->add('flotteurSegments', CollectionType::class, [], [
            'edit' => 'inline',
            'inline' => 'table',
            'sortable' => 'position',
        ]);
    }

    protected function configureDatagridFilters(DatagridMapper $datagrid): void
    {
        $datagrid->add('nomSegment')->add('longeur', null, ['label' => 'Longeur (m)'])->add('pasEmplacement');
    }

    protected function configureListFields(ListMapper $list): void
    {
        $list->addIdentifier('nomSegment')->add('longeur', null, ['label' => 'Longeur (m)'])->add('pasEmplacement');
    }

    protected function configureShowFields(ShowMapper $show): void
    {
        $show
            ->add('nomSegment')
            ->add('longeur', null, ['label' => 'Longeur (m)'])
            ->add('pasEmplacement');
    }
}
