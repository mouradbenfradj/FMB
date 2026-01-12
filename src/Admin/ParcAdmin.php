<?php

namespace App\Admin;

use App\Form\FiliereType;
use App\Service\Cache\ParcCacheService;
use Sonata\Form\Type\CollectionType;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Symfony\Component\Form\Extension\Core\Type\TextType;

final class ParcAdmin extends AbstractAdmin
{
    private ?ParcCacheService $parcCache = null;

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
        $list->addIdentifier('id')->add('libParc')->add('abrevParc');
    }

    protected function configureShowFields(ShowMapper $show): void
    {
        $show->add('libParc')->add('abrevParc');
    }

    public function setParcCacheService(ParcCacheService $parcCache): void
    {
        $this->parcCache = $parcCache;
    }

    private function refreshParcsCache(): void
    {
        if ($this->parcCache instanceof ParcCacheService) {
            $this->parcCache->refreshCache();
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
