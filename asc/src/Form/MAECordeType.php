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
use Symfony\Component\Form\Extension\Core\Type\TextType;
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
            ])
            ->addDependent('disponibilite', 'corde', function (DependentField $field, ?Corde $corde) {
                if ($corde) {
                    // Calcul de la quantité disponible (comme avant)
                    $stockCordes = $corde->getStockCordes()->filter(
                        fn(StockCorde $sc) => $sc->getDatedecreation() !== null && $sc->isPret() === false
                    );
                    $totalQuantiter = array_sum($stockCordes->map(fn(StockCorde $sc) => $sc->getQuantiter())->toArray());

                    // Champ 1 : Quantité disponible
                    $field->add(IntegerType::class, [
                        'label' => 'Quantité disponible',
                        'attr' => ['class' => 'form-control', 'readonly' => true],
                        'data' => $totalQuantiter,
                    ]);

                    // Champ 2 : Liste des articles (StockCorde) disponibles
                    $field->add(EntityType::class, [
                        'label' => 'Articles disponibles',
                        'class' => StockCorde::class,
                        'choices' => $stockCordes,
                        'choice_label' => fn(StockCorde $sc) => sprintf(
                            'Lot: %s - Quantité: %d',
                            $sc->getStockArticleSn() ? $sc->getStockArticleSn()->getNumeroSerie() : 'N/A',
                            $sc->getQuantiter()
                        ),
                        'placeholder' => 'Sélectionnez un article',
                        'attr' => ['class' => 'form-control'],
                    ]);
                }
            })

            // Champ dépendant pour afficher le lot de l'article sélectionné
            ->addDependent('lot_article', 'disponibilite', function (DependentField $field, ?StockCorde $stockCorde) {
                if ($stockCorde && $stockCorde->getStockArticleSn()) {
                    $field->add(TextType::class, [
                        'label' => 'Lot sélectionné',
                        'attr' => ['class' => 'form-control', 'readonly' => true],
                        'data' => $stockCorde->getStockArticleSn()->getNumeroSerie(),
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
