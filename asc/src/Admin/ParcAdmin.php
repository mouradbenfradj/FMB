<?php

namespace App\Admin;

use App\Form\FiliereType;
use App\Service\ParcCacheService;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;
use Sonata\Form\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

final class ParcAdmin extends AbstractAdmin
{
    protected function configureFormFields(FormMapper $form): void
    {
        $form->add('libParc', TextType::class)->add('abrevParc');
        /* ->add('filieres', CollectionType::class) */
    }

    protected function configureDatagridFilters(DatagridMapper $datagrid): void
    {
        $datagrid->add('libParc')->add('abrevParc');
    }

    protected function configureListFields(ListMapper $list): void
    {
        $list->addIdentifier('libParc')->add('abrevParc');
    }

    protected function configureShowFields(ShowMapper $show): void
    {
        $show->add('libParc')->add('abrevParc');
    }

    private function refreshParcsCache(): void
    {
        $container = $this->getConfigurationPool()->getContainer();

        if ($container->has(ParcCacheService::class)) {
            /** @var ParcCacheService $parcCache */
            $parcCache = $container->get(ParcCacheService::class);
            $parcCache->refreshCache();
        }
    }

    public function postPersist(object $object): void
    {
        $this->refreshParcsCache();
    }

    public function postUpdate(object $object): void
    {
        $this->refreshParcsCache();
    }

    public function postRemove(object $object): void
    {
        $this->refreshParcsCache();
    }
}
