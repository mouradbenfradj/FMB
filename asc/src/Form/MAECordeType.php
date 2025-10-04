<?php

namespace App\Form;

use App\Entity\Corde;
use App\Entity\FruitDeMer;
use App\Entity\Parc;
use App\Entity\Phase;
use App\Entity\Processus;
use App\Entity\Stock;
use App\Entity\StockArticle;
use App\Entity\StockArticleSn;
use App\Entity\StockCorde;
use App\Model\MAECordeModel;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
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
            ->add('stocks', EntityType::class, [
                'class' => Stock::class,
                'label' => 'STOCK DU PARC',
                'choice_label' => 'abrevStock',
                'multiple' => false,
                'expanded' => false,
                'choices' => $parc->getStocks(),
                'choice_value' => 'id',
                'placeholder' => 'choisie un stock',
                'attr' => ['class' => 'form-control'],
            ])
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
            ])->add('fruitDeMer', EntityType::class, [
                'class' => FruitDeMer::class,
                'label' => 'ESPECE',
                'choice_label' => 'nom',
                'multiple' => false,
                'expanded' => false,
                'choice_value' => 'id',
                'placeholder' => 'choisie l\'espece a préparer',
                'attr' => ['class' => 'form-control'],
            ])->addDependent('article', ['stocks', 'fruitDeMer'], function (DependentField $field, ?Stock $stock, ?FruitDeMer $fruitDeMer) use ($parc) {
                if ($fruitDeMer && $stock) {

                    $stockArticles = $stock->getStockArticles()->toArray();
                    $article = array_filter($stockArticles, function (StockArticle $stockArticle) use ($fruitDeMer) {
                        return $stockArticle->getArticles()->getFruitDeMer() === $fruitDeMer;
                    });
                    $field->add(EntityType::class, [
                        'class' => StockArticle::class,
                        'label' => 'choisir l\'article a mettre',
                        'choices' => $article,
                        'choice_label' => 'articles',
                        'choice_value' => 'id',
                        'placeholder' => 'choisie l\'article a préparer',
                        'attr' => ['class' => 'form-control'],
                    ]);
                }
            })->addDependent('lot',  ['stocks', 'fruitDeMer', 'article'], function (DependentField $field, ?stock $stock, ?FruitDeMer $fruitDeMer, ?StockArticle $articles) use ($parc) {
                if (!$articles) {
                    return;
                }
                if ($articles) {
                    $stockArticleSn = $articles->getStockArticleSns()->toArray();
                    $field->add(EntityType::class, [
                        'class' => StockArticleSn::class,
                        'label' => 'choisir le lot de l\'article',
                        'choices' => $stockArticleSn,
                        'choice_label' => 'numeroSerie',
                        'choice_value' => 'id',
                        'placeholder' => 'choisie le lot d\'article',
                        'attr' => ['class' => 'form-control'],
                    ]);
                }
            })->addDependent('disponibiliter', 'corde', function (DependentField $field, ?Corde $corde) use ($parc) {
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
            })->addDependent('densiter', ['corde', 'fruitDeMer', 'article', 'lot'], function (DependentField $field, ?Corde $corde) use ($parc) {
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
                        'label' => 'Densité (U/Corde)',
                        'attr' => ['value' => $totalQuantiter, 'class' => 'form-control', 'readonly' => true],
                        'data' => $totalQuantiter,
                    ]);
                }
            })->add('phase', EntityType::class, [
                'class' => Phase::class,
                'label' => 'Phase',
                'choice_label' => 'nomPhase',
                'multiple' => false,
                'expanded' => false,
                'choice_value' => 'id',
                'placeholder' => 'choisie la phase',
                'attr' => ['class' => 'form-control'],
            ])->addDependent('processus', ['phase'], function (DependentField $field, ?Phase $phase) use ($parc) {
                if ($phase) {

                    $processus = $phase->getProcessuses()->toArray();
                    /* $processus = array_filter($processus, function (StockArticle $stockArticle) use ($fruitDeMer) {
                        return $stockArticle->getArticles()->getFruitDeMer() === $fruitDeMer;
                    }); */
                    $field->add(EntityType::class, [
                        'class' => Processus::class,
                        'label' => 'choisir le processus',
                        'choices' => $processus,
                        'choice_label' => 'nomProcessus',
                        'choice_value' => 'id',
                        'placeholder' => 'choisie le processus',
                        'attr' => ['class' => 'form-control'],
                    ]);
                }
            })
            ->addDependent('submit',  ['processus', 'lot'], function (DependentField $field, ?Processus $processus, ?StockArticleSn $stockArticleSn) use ($parc) {
                if ($processus && $stockArticleSn) {
                    $field->add(SubmitType::class, [
                        'attr' => ['class' => 'btn btn-primary waves-effect waves-light', 'value' => 'Validation'],
                    ]);
                }
            });
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'attr' => [
                'id' => 'mae_corde',
                'data-model' => 'on(change)|*'
            ],
            'data_class' => MAECordeModel::class,
            'parc' => Parc::class,
        ]);
    }
}
