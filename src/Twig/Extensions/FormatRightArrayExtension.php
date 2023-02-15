<?php

declare(strict_types=1);

namespace  Arobases\SyliusRightsManagementPlugin\Twig\Extensions;

use Symfony\Component\Form\FormView;
use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

final class FormatRightArrayExtension extends AbstractExtension
{
    public function getFunctions(): array
    {
        return [
            new TwigFunction('arobases_rights_plugin_get_formatted_right_array', [$this, 'getFormattedRightArray']),
        ];
    }

    public function getFormattedRightArray(FormView $rightsArray): ?array
    {
        $arrayRightFormatted = [];
        foreach ($rightsArray as $rightArray) {
            /** @var FormView $rightArray */
            $group = $rightArray->vars['attr']['data-group'];
            if (array_key_exists($group, $arrayRightFormatted)) {
                $arrayRightFormatted[$group][] = $rightArray;
            } else {
                $arrayRightFormatted[$group] = [$rightArray];
            }
        }

        return $arrayRightFormatted;
    }
}
