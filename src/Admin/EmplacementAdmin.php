<?php

declare(strict_types=1);

namespace App\Admin;

use App\Entity\Segment;
use App\Entity\StockCorde;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Form\Type\CollectionType;
use Sonata\AdminBundle\Show\ShowMapper;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

final class EmplacementAdmin extends AbstractAdmin
{
    protected function configureDatagridFilters(DatagridMapper $filter): void
    {
        $filter
            ->add('id')
            ->add('place')->add('segment.filiere.nomFiliere')
            /* ->add('segment', EntityType::class, [
                'class' => Segment::class,
                'choice_label' => 'nomSegment',
            ]) */
            ->add('stockCordes');
    }

    protected function configureListFields(ListMapper $list): void
    {
        $list
            ->addIdentifier('id')
            ->add('place')
            ->add('segment.nomSegment')
            ->add('stockCordes')
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
            ->add('place')
            ->add('stockCordes', CollectionType::class, [
                // each entry in the array will be an "email" field
                'entry_type' => EntityType::class,
                // these options are passed to each "email" type
                'entry_options' => [
                    'class' => StockCorde::class,
                ],
                'allow_add' => true,
                'allow_delete' => true,
                'by_reference' => false,
            ]);
    }

    protected function configureShowFields(ShowMapper $show): void
    {
        $show
            ->add('id')
            ->add('place')
        ;
    }
}
