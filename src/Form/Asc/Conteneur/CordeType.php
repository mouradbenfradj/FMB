<?php

namespace App\Form\Asc\Conteneur;

use App\Entity\Asc\Conteneur\Corde;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CordeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('quantiter')
            ->add('nom')
            ->add('longeur')
            ->add('parc')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Corde::class,
        ]);
    }
}
