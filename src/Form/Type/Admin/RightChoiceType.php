<?php

declare(strict_types=1);

namespace Arobases\SyliusRightsManagementPlugin\Form\Type\Admin;

use Arobases\SyliusRightsManagementPlugin\Entity\RightGroup;
use Arobases\SyliusRightsManagementPlugin\Repository\Right\RightRepository;
use Sylius\Component\Resource\Repository\RepositoryInterface;
use Symfony\Bridge\Doctrine\Form\DataTransformer\CollectionToArrayTransformer;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\Options;
use Symfony\Component\OptionsResolver\OptionsResolver;

final class RightChoiceType extends AbstractType
{

    private RightRepository $rightRepository;

    public function __construct(RightRepository $rightRepository)
    {
        $this->rightRepository = $rightRepository;
    }

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        if ($options['multiple']) {
            $builder->addModelTransformer(new CollectionToArrayTransformer());
        }
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'choices' => function (Options $options): array {
                return $this->rightRepository->findAll();
            },
            'choice_value' => 'id',
            'choice_label' => 'name',
            'choice_attr' => function($choice, $key, $value) {

                return ['data-group' => $choice->getRightGroup()->getName()];
            },
        ]);
    }

    public function getParent(): string
    {
        return ChoiceType::class;
    }
}
