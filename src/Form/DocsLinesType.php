<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class DocsLinesType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('refArticle', 'entity', array('class' => 'App/Articles', 'label' => 'article', 'attr' => array('class' => "form-control")))
            ->add('numeroSerie', 'entity', array('class' => 'App/StocksArticlesSn', 'label' => 'lot', 'mapped' => false, 'attr' => array('class' => "form-control")))
            ->add('qte', 'number', array('label' => 'Densiter','attr' => array( 'class' => "form-control")))
            ->add('nombre', 'number', array('label' => 'nombre de lanterne a fabriquer', 'mapped' => false,'attr' => array( 'class' => "form-control")));

    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(
            array('data_class' => 'App\Entity\DocsLines',)
        );
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'ss_fmbbundle_docslines';
    }
}
