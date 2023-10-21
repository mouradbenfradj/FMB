<?php

namespace App\Admin;

use App\Entity\Asc\Stock;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Form\Type\ModelType;
use Sonata\AdminBundle\Show\ShowMapper;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

final class ParcAdmin extends AbstractAdmin
{

    protected function configureFormFields(FormMapper $form): void
    {
        $form->add('libParc')->add('abrevParc')
            /* ->add('stocks', EntityType::class, [
                'class' => Stock::class,
                'choice_label' => 'libStock',
            ]) */;
    }

    protected function configureDatagridFilters(DatagridMapper $datagrid): void
    {
        $datagrid->add('idParc')->add('libParc')->add('abrevParc')->add('stocks');
    }

    protected function configureListFields(ListMapper $list): void
    {
        $list->addIdentifier('idParc')->add('libParc')->add('abrevParc')->add('stocks');
    }

    protected function configureShowFields(ShowMapper $show): void
    {
        $show->add('idParc')->add('libParc')->add('abrevParc')->add('stocks');
    }
}
