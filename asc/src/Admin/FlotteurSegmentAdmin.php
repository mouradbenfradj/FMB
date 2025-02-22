<?php

namespace App\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

final class FlotteurSegmentAdmin extends AbstractAdmin
{
    protected function configureFormFields(FormMapper $form): void
    {
        $form->add('nombre', IntegerType::class)->add('distanceDeDepart')->add('pasFlotteur');
    }

    protected function configureDatagridFilters(DatagridMapper $datagrid): void
    {
        $datagrid->add('nombre')->add('distanceDeDepart')->add('pasFlotteur');
    }

    protected function configureListFields(ListMapper $list): void
    {
        $list->addIdentifier('nombre')->add('distanceDeDepart')->add('pasFlotteur');
    }

    protected function configureShowFields(ShowMapper $show): void
    {
        $show->add('nombre')->add('distanceDeDepart')->add('pasFlotteur');
    }
}
