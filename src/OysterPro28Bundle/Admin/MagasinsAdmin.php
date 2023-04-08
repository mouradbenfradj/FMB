<?php
namespace OysterPro28Bundle\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;

class MagasinsAdmin extends AbstractAdmin
{
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper->add('libMagasin')->add('abrevMagasin')->add('modeVente')->add('actif')->add('idStock');
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper->add('idMagasin')->add('libMagasin')->add('abrevMagasin')->add('idStock');
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper->addIdentifier('idMagasin')->add('libMagasin')->add('abrevMagasin')->add('idStock');
    }
}
