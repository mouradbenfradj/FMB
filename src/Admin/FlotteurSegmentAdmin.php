<?php

namespace App\Admin;

use App\Entity\Flotteur;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;

final class FlotteurSegmentAdmin extends AbstractAdmin
{
    protected function configureFormFields(FormMapper $form): void
    {
        $form->add('flotteur', EntityType::class, [
            'class' => Flotteur::class,
            'choice_label' => 'nomFlotteur',
        ])
            ->add('distanceDeDepart', NumberType::class)
            ->add('pasFlotteur', NumberType::class)
            ->add('nombre');
    }

    protected function configureDatagridFilters(DatagridMapper $datagrid): void
    {
        $datagrid
            ->add('id')
            ->add('segment')
            ->add('flotteur')
            ->add('distanceDeDepart', NumberType::class)
            ->add('pasFlotteur', NumberType::class)
            ->add('nombre');
    }

    protected function configureListFields(ListMapper $list): void
    {
        $list
            ->addIdentifier('id')
            ->add('segment', null, ['associated_property' => 'nomSegment'])
            ->add('flotteur', null, ['associated_property' => 'nomFlotteur'])
            ->add('distanceDeDepart', NumberType::class)
            ->add('pasFlotteur', NumberType::class)
            ->add('nombre');
    }

    protected function configureShowFields(ShowMapper $show): void
    {
        $show->add('distanceDeDepart')->add('pasFlotteur')->add('nombre');
    }
}
