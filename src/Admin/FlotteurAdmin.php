<?php

namespace App\Admin;

use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Sonata\AdminBundle\FieldDescription\FieldDescriptionInterface;

final class FlotteurAdmin extends AbstractAdmin
{
    protected function configureFormFields(FormMapper $form): void
    {
        $form
            ->add('nomFlotteur', TextType::class)
            ->add('volume', NumberType::class, [
                'label' => 'Volume (L)',
            ])
            ->add('taux', NumberType::class);
    }

    protected function configureDatagridFilters(DatagridMapper $datagrid): void
    {
        $datagrid->add('id',)
            ->add('nomFlotteur')
            ->add('volume', null, [
                'label' => 'Volume (L)',
            ])
            ->add('kgf')
            ->add('taux');;
    }

    protected function configureListFields(ListMapper $list): void
    {
        $list
            ->addIdentifier('id')
            ->add('nomFlotteur')
            ->add('volume', null, [
                'label' => 'Volume (L)',
            ])
            ->add('kgf')
            ->add('flotteurSegments')
            ->add('taux');
    }

    protected function configureShowFields(ShowMapper $show): void
    {
        $show
            ->add('nomFlotteur', TextType::class)
            ->add('volume', NumberType::class, [
                'label' => 'Volume (L)',
            ])
            ->add('kgf', NumberType::class)
            ->add('taux', NumberType::class);
    }
}
