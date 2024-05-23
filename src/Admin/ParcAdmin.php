<?php

namespace App\Admin;

use App\Entity\Asc\Parc;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Form\Type\ModelType;
use Sonata\AdminBundle\Show\ShowMapper;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use App\Entity\Asc\Stock\Stock;
use Sonata\Form\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;

final class ParcAdmin extends AbstractAdmin
{

    protected function configureFormFields(FormMapper $form): void
    {
        $form
            ->with('Parc')
            ->add('libParc')
            ->add('abrevParc')
            ->end()
            /* ->with('Stocks')
            ->add('stocks', CollectionType::class, [
                'type_options' => [
                    // Prevents the "Delete" option from being displayed
                    'delete' => true
                ]
            ], [
                'edit' => 'inline',
                'inline' => 'table',
                'sortable' => 'position',
            ]) */;
    }

    protected function configureDatagridFilters(DatagridMapper $datagrid): void
    {
        $datagrid->add('libParc')->add('abrevParc')->add('stocks')->add('filieres')->add('cordes')->add('lanternes');
    }

    protected function configureListFields(ListMapper $list): void
    {
        $list->addIdentifier('id')->add('libParc')->add('abrevParc')->add('stocks')->add('filieres')->add('cordes')->add('lanternes');
    }

    protected function configureShowFields(ShowMapper $show): void
    {
        $show->add('libParc')->add('abrevParc')->add('stocks')->add('filieres')->add('cordes')->add('lanternes');
    }
}