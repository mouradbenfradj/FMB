<?php

namespace App\Form;

use App\Entity\Articles;
use App\Entity\Corde;
use App\Entity\FruitDeMer;
use App\Entity\Parc;
use App\Entity\Stock;
use App\Entity\StockArticle;
use App\Entity\StockArticleSn;
use App\Model\PreparationCordeModel;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfonycasts\DynamicForms\DependentField;
use Symfonycasts\DynamicForms\DynamicFormBuilder;

class PreparationCordeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {

        $parc = $options['parc'];

        if (!$parc instanceof Parc) {
            throw new \InvalidArgumentException('The "parc" option must be an instance of Parc.');
        }

        $builder = new DynamicFormBuilder($builder);

        // Champ "stocks"
        $builder->add('stocks', EntityType::class, [
            'class' => Stock::class,
            'choice_label' => 'abrevStock',
            'multiple' => false,
            'expanded' => false,
            'choices' => $parc->getStocks(),
            'choice_value' => 'id',
            'placeholder' => 'choisie un stock',
        ])
            ->add('corde', EntityType::class, [
                'class' => Corde::class,
                'choice_label' => 'nom',
                'multiple' => false,
                'expanded' => false,
                'choices' => $parc->getCordes(),
                'choice_value' => 'id',
                'placeholder' => 'choisie ton type de corde',
            ])
            ->add('longeur', NumberType::class)
            ->add('datedecreation', DateType::class, ['html5' => true, 'widget' => 'single_text', 'attr' => ['data-provide' => "datepicker"]])
            ->addDependent('quantiteEnStock', 'corde', function (DependentField $field, ?Corde $corde) use ($parc) {
                if ($corde) {
                    $quantiter = $corde->getQuantiter();
                    $field->add(IntegerType::class, [
                        'attr' => ['value' => $quantiter],
                        'data' => $quantiter,
                    ]);
                }
            })->add('fruitDeMer', EntityType::class, [
                'class' => FruitDeMer::class,
                'choice_label' => 'nom',
                'multiple' => false,
                'expanded' => false,
                'choice_value' => 'id',
                'placeholder' => 'choisie l\'espece a préparer',
            ])->addDependent('article', ['stocks', 'fruitDeMer'], function (DependentField $field, ?stock $stock, ?FruitDeMer $fruitDeMer) use ($parc) {
                if ($fruitDeMer && $stock) {

                    $stockArticles = $stock->getStockArticles()->toArray();
                    $article = array_filter($stockArticles, function (StockArticle $stockArticle) use ($fruitDeMer) {
                        return $stockArticle->getArticles()->getFruitDeMer() === $fruitDeMer;
                    });
                    $field->add(EntityType::class, [
                        'class' => StockArticle::class,
                        'choices' => $article,
                        'choice_label' => 'articles',
                        'choice_value' => 'id',
                        'placeholder' => 'choisie l\'article a préparer',
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
                        'choices' => $stockArticleSn,
                        'choice_label' => 'numeroSerie',
                        'choice_value' => 'id',
                        'placeholder' => 'choisie le lot d\'article',
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
                        'attr' => ['value' =>  $snQte],
                        'data' =>  $snQte,
                    ]);
                }
            })->add('densite', IntegerType::class)


            /*
            =->add('totalqte', NumberType::class, [
                'attr' => ['readonly' => true],

                'data' => 0,
            ])->add('datedecreation', DateType::class, [
                'widget' => 'single_text',
                'attr' => ['readonly' => true],
            ])->add('quantiter', TextType::class, [
                'required' => true,
            ]) */

            ->add('nombre', IntegerType::class, [
                'required' => true,

            ])
            ->addDependent('submit',  ['corde', 'lot'], function (DependentField $field, ?Corde $corde, ?StockArticleSn $stockArticleSn) use ($parc) {
                if ($stockArticleSn && $corde) {
                    $field->add(SubmitType::class, [
                        'attr' => ['class' => 'btn btn-primary waves-effect waves-light', 'value' => 'Validation'],
                    ]);
                }
            });
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => PreparationCordeModel::class,
            'parc' => Parc::class,
        ]);
    }
}
