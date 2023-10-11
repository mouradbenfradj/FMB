<?php

namespace App\Admin;

use App\Entity\Asc\Parc;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Form\Type\ModelType;
use Sonata\AdminBundle\Show\ShowMapper;

final class StockAdmin extends AbstractAdmin
{

    protected function configureFormFields(FormMapper $form): void
    {
        $form->add('libStock')->add('parc', ModelType::class, [
            'class' => Parc::class,
            'property' => 'libParc',
        ]);
    }

    protected function configureDatagridFilters(DatagridMapper $datagrid): void
    {
        $datagrid->add('id')->add('libStock');
    }

    protected function configureListFields(ListMapper $list): void
    {
        $list->addIdentifier('id')->add('libStock');
    }

    protected function configureShowFields(ShowMapper $show): void
    {
        $show->add('id')->add('libStock');
    }
}
