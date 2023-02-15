<?php

declare(strict_types=1);

namespace Arobases\SyliusRightsManagementPlugin\Form\Type\Admin;

use Sylius\Bundle\ResourceBundle\Form\EventSubscriber\AddCodeFormSubscriber;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

final class RoleType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->addEventSubscriber(new AddCodeFormSubscriber())
            ->add('name', TextType::class, [
                'label' => 'sylius.ui.name',
            ])
            ->add('rights', RightChoiceType::class, [
                'label' => 'rights',
                'required' => false,
                'multiple' => true,
                'expanded' => true,
            ])
        ;
    }

    public function getBlockPrefix(): string
    {
        return 'arobases_sylius_rights_management_plugin_role';
    }
}
