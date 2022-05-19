<?php

declare(strict_types=1);

namespace Arobases\SyliusRightsManagementPlugin\Form\Type\Admin;

use Arobases\SyliusRightsManagementPlugin\Repository\Right\RightRepository;
use Sylius\Bundle\ChannelBundle\Form\Type\ChannelChoiceType;
use Sylius\Bundle\ResourceBundle\Form\EventSubscriber\AddCodeFormSubscriber;
use Sylius\Bundle\ResourceBundle\Form\Type\AbstractResourceType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\Options;

final class RoleType extends AbstractType
{

    private RightRepository $rightRepository;

    /**
     * RoleType constructor.
     * @param RightRepository $rightRepository
     */
    public function __construct(RightRepository $rightRepository)
    {
        $this->rightRepository = $rightRepository;
    }


    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->addEventSubscriber(new AddCodeFormSubscriber())
            ->add('name', TextType::class, [
                'label' => 'sylius.ui.name'
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
        return 'arobases_admin_role';
    }
}
