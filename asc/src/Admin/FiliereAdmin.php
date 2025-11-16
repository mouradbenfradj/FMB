<?php

namespace App\Admin;

use App\Entity\Parc;
use App\Entity\Segment;
use App\Service\ParcCacheService;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;
use Sonata\Form\Type\CollectionType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

final class FiliereAdmin extends AbstractAdmin
{
    private ?ParcCacheService $parcCache = null;

    protected function configureFormFields(FormMapper $form): void
    {
        $form
            ->with('Filiere')
            ->add('parc', EntityType::class, [
                'class' => Parc::class,
                'choice_label' => 'libParc',
            ])
            ->add('nomFiliere', TextType::class)
            // ->add('observation')
            ->add('aireDeTravaille')
            ->end()
            ->with('Segments')
            ->add('segments', CollectionType::class, [], [
                'edit' => 'inline',
                'inline' => 'table',
                'sortable' => 'position',
            ])
            ->end();
    }

    protected function configureDatagridFilters(DatagridMapper $datagrid): void
    {
        $datagrid->add('parc.libParc')->add('nomFiliere')->add('observation')->add('aireDeTravaille');
    }

    protected function configureListFields(ListMapper $list): void
    {
        $list->addIdentifier('id')->add('parc.libParc')->add('nomFiliere')->add('observation')->add('aireDeTravaille');
    }

    protected function configureShowFields(ShowMapper $show): void
    {
        $show->add('parc', EntityType::class, [
            'class' => Parc::class,
            'choice_label' => 'libParc',
        ])->add('nomFiliere')->add('observation')->add('aireDeTravaille');
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
