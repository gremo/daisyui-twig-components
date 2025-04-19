<?php

/*
 * This file is part of the daisyui-twig-components package.
 *
 * (c) Marco Polichetti <gremo1982@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Gremo\DaisyUITwigComponents\Twig\Components;

use Gremo\DaisyUITwigComponents\Twig\ValidableComponentInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\UX\TwigComponent\Attribute\ExposeInTemplate;
use Symfony\UX\TwigComponent\Attribute\PreMount;
use Symfony\UX\TwigComponent\ComponentAttributes;

class Tabs implements ValidableComponentInterface
{
    public string $as = 'div';

    public string $id;

    public ?string $placement = null;

    public ?string $size = null;

    public ?string $style = null;

    #[PreMount]
    public function preMount(array $data): array
    {
        return [
            'id' => 'tabs-'.mt_rand(),
            ...$data,
        ];
    }

    public function configureProps(OptionsResolver $resolver): void
    {
        $resolver
            ->setAllowedValues('placement', ['top', 'bottom'])
            ->setAllowedValues('size', ['lg', 'md', 'sm', 'xl', 'xs'])
            ->setAllowedValues('style', ['border', 'box', 'lift'])
        ;
    }

    #[ExposeInTemplate]
    public function getInputAttributes(): ComponentAttributes
    {
        return new ComponentAttributes([
            'name' => "$this->id-input",
        ]);
    }
}
