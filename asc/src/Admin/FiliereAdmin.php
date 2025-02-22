<?php

namespace App\Admin;

use App\Entity\Parc;
use App\Entity\Segment;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;
use Sonata\Form\Type\CollectionType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

final class FiliereAdmin extends AbstractAdmin
{
    protected function configureFormFields(FormMapper $form): void
    {
        $form->add('parc', EntityType::class, [
            'class' => Parc::class,
            'choice_label' => 'libParc',
        ])
            ->add('nomFiliere', TextType::class)
            ->add('observation')
            ->add('aireDeTravaille')
            ->add('segments', CollectionType::class)
        ;
    }

    protected function configureDatagridFilters(DatagridMapper $datagrid): void
    {
        $datagrid->add('parc')->add('nomFiliere')->add('observation')->add('aireDeTravaille');
    }

    protected function configureListFields(ListMapper $list): void
    {
        $list->addIdentifier('id')->add('parc')->add('nomFiliere')->add('observation')->add('aireDeTravaille');
    }

    protected function configureShowFields(ShowMapper $show): void
    {
        $show->add('parc')->add('nomFiliere')->add('observation')->add('aireDeTravaille');
    }
}
