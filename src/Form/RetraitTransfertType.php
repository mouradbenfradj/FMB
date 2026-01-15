<?php

namespace App\Form;

use App\Model\RetraitTransfertModel;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class RetraitTransfertType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('dateTransfert', DateType::class, [
                'label' => 'Date de transfert',
                'html5' => true,
                'widget' => 'single_text',
                'attr' => ['data-provide' => "datepicker", 'class' => 'form-control'],
            ])
            ->add('submit', SubmitType::class, [
                'label' => 'Valider',
                'attr' => ['class' => 'btn btn-primary waves-effect waves-light'],
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => RetraitTransfertModel::class,
        ]);
    }
}
