<?php

namespace App\Form;

use App\Entity\FruitDeMer;
use App\Entity\Lanterne;
use App\Entity\Parc;
use App\Entity\Stock;
use App\Entity\StockArticle;
use App\Entity\StockArticleSn;
use App\Model\PreparationLanterneModel;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfonycasts\DynamicForms\DependentField;
use Symfonycasts\DynamicForms\DynamicFormBuilder;

class PreparationLanterneType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {

        $parc = $options['parc'];

        if (!$parc instanceof Parc) {
            throw new \InvalidArgumentException('The "parc" option must be an instance of Parc.');
        }

        $builder = new DynamicFormBuilder($builder);

        // Champ "stocks"
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
            ->add('lanterne', EntityType::class, [
                'class' => Lanterne::class,
                'label' => 'TYPE LANTERNE',
                'choice_label' => 'nom',
                'multiple' => false,
                'expanded' => false,
                'choices' => $parc->getLanternes(),
                'choice_value' => 'id',
                'placeholder' => 'choisie ton type de lanterne',
                'attr' => ['class' => 'form-control'],
            ])
            ->add('datedecreation', DateType::class, [
                'label' => 'DATE PREPARATION LANTERNES',
                'html5' => true,
                'widget' => 'single_text',
                'attr' => ['data-provide' => "datepicker", 'class' => 'form-control'],
            ])
            ->addDependent('quantiteEnStock', 'lanterne', function (DependentField $field, ?Lanterne $lanterne) use ($parc) {
                if ($lanterne) {
                    $quantiter = $lanterne->getNbrEnStock();
                    $field->add(IntegerType::class, [
                        'label' => 'STOCK Lanternes',
                        'attr' => ['value' => $quantiter, 'class' => 'form-control', 'readonly' => true],
                        'data' => $quantiter,
                    ]);
                }
            })->add('fruitDeMer', EntityType::class, [
                'class' => FruitDeMer::class,
                'label' => 'ESPECE',
                'choice_label' => 'nom',
                'multiple' => false,
                'expanded' => false,
                'choice_value' => 'id',
                'placeholder' => 'choisie l\'espece a préparer',
                'attr' => ['class' => 'form-control'],
            ])->addDependent('article', ['stocks', 'fruitDeMer'], function (DependentField $field, ?stock $stock, ?FruitDeMer $fruitDeMer) use ($parc) {
                if ($fruitDeMer && $stock) {

                    $stockArticles = $stock->getStockArticles()->toArray();
                    $article = array_filter($stockArticles, function (StockArticle $stockArticle) use ($fruitDeMer) {
                        return $stockArticle->getArticles()->getFruitDeMer() === $fruitDeMer;
                    });
                    $field->add(EntityType::class, [
                        'class' => StockArticle::class,
                        'label' => 'ARTICLES',
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
                        'label' => 'LOT ARTICLES',
                        'choices' => $stockArticleSn,
                        'choice_label' => 'numeroSerie',
                        'choice_value' => 'id',
                        'placeholder' => 'choisie le lot d\'article',
                        'attr' => ['class' => 'form-control'],
                    ]);
                }
            })->addDependent('totalqte',  ['stocks', 'fruitDeMer', 'article', 'lot'], function (DependentField $field, ?stock $stock, ?FruitDeMer $fruitDeMer, ?StockArticle $articles, ?StockArticleSn $stockArticleSn) use ($parc) {
                if (!$articles) {
                    return;
                }
                $snQte = $parc->getStocks()->first()->getStockArticles()->first()->getStockArticleSns()->first()->getSnQte();
                if ($stockArticleSn) {
                    $snQte = $stockArticleSn->getSnQte();
                    $field->add(IntegerType::class, [
                        'label' => 'STOCK LOT',
                        'attr' => ['value' =>  $snQte, 'class' => 'form-control', 'readonly' => true],
                        'data' =>  $snQte,
                    ]);
                }
            })->add('densite', IntegerType::class, [
                'label' => 'UNITES/LANTERNE',
                'attr' => ['class' => 'form-control'],
            ])
            ->add('nombre', IntegerType::class, [
                'label' => 'NBR LANTERNES A FABRIQUER',
                'required' => true,
                'attr' => ['class' => 'form-control'],
            ])
            ->addDependent('submit',  ['lanterne', 'lot'], function (DependentField $field, ?Lanterne $lanterne, ?StockArticleSn $stockArticleSn) use ($parc) {
                if ($stockArticleSn && $lanterne) {
                    $field->add(SubmitType::class, [
                        'attr' => ['class' => 'btn btn-primary waves-effect waves-light', 'value' => 'Validation'],
                    ]);
                }
            });
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => PreparationLanterneModel::class,
            'parc' => Parc::class,
        ]);
    }
}
