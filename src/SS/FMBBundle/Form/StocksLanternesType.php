<?php

namespace SS\FMBBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class StocksLanternesType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('pret')
            ->add('dateDeCreation')
            ->add('lanterne')
            ->add('emplacement')
            ->add('parc')
            ->add('article')
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'SS\FMBBundle\Entity\StocksLanternes'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'ss_fmbbundle_stockslanternes';
    }
}
