<?php

namespace App\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;

final class StockCordeAdmin extends AbstractAdmin
{

    protected function configureFormFields(FormMapper $form): void
    {
        $form->add('corde')->add('stockArticleSn')->add('emplacement')->add('quantiter')->add('datedecreation')->add('datederetirement')->add('datederetraittransfert')->add('datedemaetransfert')->add('dateDeMiseAEaudate')->add('chaussement')->add('dateassemblage')->add('datechaussement');
    }

    protected function configureDatagridFilters(DatagridMapper $datagrid): void
    {
        $datagrid->add('id')->add('corde')->add('stockArticleSn')->add('quantiter')->add('emplacement')->add('datedecreation')->add('datederetirement')->add('datederetraittransfert')->add('datedemaetransfert')->add('dateDeMiseAEaudate')->add('chaussement')->add('dateassemblage')->add('datechaussement');
    }

    protected function configureListFields(ListMapper $list): void
    {
        $list->addIdentifier('id')->add('corde')->add('stockArticleSn')->add('quantiter')->add('emplacement')->add('datedecreation')->add('datederetirement')->add('datederetraittransfert')->add('datedemaetransfert')->add('dateDeMiseAEaudate')->add('chaussement')->add('dateassemblage')->add('datechaussement');
    }

    protected function configureShowFields(ShowMapper $show): void
    {
        $show->add('id')->add('corde')->add('stockArticleSn')->add('quantiter')->add('emplacement')->add('datedecreation')->add('datederetirement')->add('datederetraittransfert')->add('datedemaetransfert')->add('dateDeMiseAEaudate')->add('chaussement')->add('dateassemblage')->add('datechaussement');
    }
}