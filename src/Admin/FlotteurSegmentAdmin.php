<?php

namespace App\Admin;

use App\Entity\Flotteur;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

final class FlotteurSegmentAdmin extends AbstractAdmin
{
    protected function configureFormFields(FormMapper $form): void
    {
        $form->add('flotteur', EntityType::class, [
            'class' => Flotteur::class,
            'choice_label' => 'nomFlotteur',
        ])->add('distanceDeDepart')->add('pasFlotteur')->add('nombre', IntegerType::class);
    }

    protected function configureDatagridFilters(DatagridMapper $datagrid): void
    {
        $datagrid->add('distanceDeDepart')->add('pasFlotteur')->add('nombre');
    }

    protected function configureListFields(ListMapper $list): void
    {
        $list->addIdentifier('id')->add('distanceDeDepart')->add('pasFlotteur')->add('nombre');
    }

    protected function configureShowFields(ShowMapper $show): void
    {
        $show->add('distanceDeDepart')->add('pasFlotteur')->add('nombre');
    }
}
