<?php

namespace App\Form;

use App\Entity\Corde;
use App\Entity\Parc;
use App\Model\MAECordeModel;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfonycasts\DynamicForms\DynamicFormBuilder;

class MAECordeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {

        $parc = $options['parc'];

        if (!$parc instanceof Parc) {
            throw new \InvalidArgumentException('The "parc" option must be an instance of Parc.');
        }

        $builder = new DynamicFormBuilder($builder);

        $builder
            ->add('corde', EntityType::class, [
                'class' => Corde::class,
                'label' => 'TYPE CORDE',
                'choice_label' => 'nom',
                'multiple' => false,
                'expanded' => false,
                'choices' => $parc->getCordes(),
                'choice_value' => 'id',
                'placeholder' => 'choisie ton type de corde',
                'attr' => ['class' => 'form-control'],
            ])
            ->add('datedeMAE', DateType::class, [
                'label' => 'DATE MAE CORDES',
                'html5' => true,
                'widget' => 'single_text',
                'attr' => ['data-provide' => "datepicker", 'class' => 'form-control'],
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => MAECordeModel::class,
            'parc' => Parc::class,
        ]);
    }
}
