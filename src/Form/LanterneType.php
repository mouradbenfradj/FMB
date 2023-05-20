<?php

namespace App\Form;

use App\Entity\Parc;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Doctrine\ORM\EntityManager;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\FormInterface;
class LanterneType extends AbstractType
{
    protected $em;
    function __construct()
    {
        $this->em = '';
    }

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nomLanterne')
            ->add("nbrPoche");
        $builder->addEventListener(FormEvents::PRE_SET_DATA, array($this, 'onPreSetData'));
    }

    protected function addElements(FormInterface $form, Parc $parc = null) {
        // Remove the submit button, we will place this at the end of the form later
        // Add the province element
        $form->add('parc', 'entity', array(
                'data' => $parc,
                'class' => 'App/Parc',
                'required' => true,
                'mapped' => false)
        );
        // Cities are empty, unless we actually supplied a province
        $parcs = array();
        if ($parc) {
            // Fetch the cities from specified province
            $repo = $this->em->getRepository('App/Lanterne');
            $parcs = $repo->findByProvince($parc, array('nomParc' => 'asc'));
        }
        // Add the city element
        $form->add('nomLanterne', 'entity', array(
            'empty_value' => '-- Select a province first --',
            'class' => 'App/Lanterne',
            'choices' => $parcs,
        ));
        // Add submit button again, this time, it's back at the end of the form
    }
    function onPreSetData(FormEvent $event) {
        $lanterne = $event->getData();
        $form = $event->getForm();
        // We might have an empty account (when we insert a new account, for instance)
        $parc = $lanterne->getParc() ? $lanterne->getParc() : null;
        $this->addElements($form, $parc);
    }
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(
            array(
                'data_class' => 'App\Entity\Lanterne',
            )
        );
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'ss_fmbbundle_lanterne';
    }
}
