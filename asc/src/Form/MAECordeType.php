<?php

namespace App\Form;

use App\Entity\Corde;
use App\Entity\Parc;
use App\Entity\StockCorde;
use App\Model\MAECordeModel;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfonycasts\DynamicForms\DependentField;
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
            ])->addDependent('disponibiliter', 'corde', function (DependentField $field, ?Corde $corde) use ($parc) {
                if ($corde) {
                    $stockCordes = $corde->getStockCordes()->toArray();

                    // 1. Filtrer pour garder uniquement ceux avec datedecreation !== null et pret === false
                    $filteredStockCordes = array_filter(
                        $stockCordes,
                        fn(StockCorde $sc) => $sc->getDatedecreation() !== null && $sc->isPret() === false
                    );

                    // 2. Extraire les quantités et faire la somme
                    $totalQuantiter = array_sum(
                        array_map(
                            fn(StockCorde $sc) => $sc->getQuantiter(),
                            $filteredStockCordes
                        )
                    );
                    $field->add(IntegerType::class, [
                        'label' => 'Disponible',
                        'attr' => ['value' => $totalQuantiter, 'class' => 'form-control', 'readonly' => true],
                        'data' => $totalQuantiter,
                    ]);
                }
            })

        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => MAECordeModel::class,
            'parc' => Parc::class,
        ]);
    }
}
