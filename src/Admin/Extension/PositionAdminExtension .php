<?php

namespace App\Admin\Extension;

use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Admin\AbstractAdminExtension;
use Symfony\Component\DependencyInjection\Attribute\AutoconfigureTag;

#[AutoconfigureTag(name: 'sonata.admin.extension', attributes: ['target' => 'sonata.page.admin.page'])]
final class PositionAdminExtension extends AbstractAdminExtension
{
    public function configureFormFields(FormMapper $form): void
    {
        $form->add('position');
    }
}
