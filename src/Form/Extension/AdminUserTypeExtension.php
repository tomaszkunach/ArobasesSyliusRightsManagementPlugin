<?php

declare(strict_types=1);

namespace Arobases\SyliusRightsManagementPlugin\Form\Extension;

use Arobases\SyliusRightsManagementPlugin\Entity\Role;
use Arobases\SyliusRightsManagementPlugin\Form\Type\Admin\RoleChoiceType;
use Sylius\Bundle\CoreBundle\Form\Type\User\AdminUserType;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractTypeExtension;
use Symfony\Component\Form\FormBuilderInterface;


class AdminUserTypeExtension extends AbstractTypeExtension
{

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder->add('role', RoleChoiceType::class, [
            'label' => 'arobases_sylius_rights_management_plugin.ui.role',
            'required' => false,
            'multiple' => false,
            'expanded' => true,
        ]);
    }

    public static function getExtendedTypes(): iterable
    {
        return [AdminUserType::class];
    }
}
