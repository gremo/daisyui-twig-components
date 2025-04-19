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
use Symfony\UX\TwigComponent\Attribute\PreMount;

class Button implements ValidableComponentInterface
{
    public string $as = 'button';

    public ?string $content = null;

    public bool $active = false;

    public bool $block = false;

    public ?string $color = null;

    public ?string $shape = null;

    public ?string $size = null;

    public ?string $variant = null;

    public bool $wide = false;

    #[PreMount]
    public function preMount(array $data): array
    {
        return [
            ...$data,
            ...('a' === ($data['as'] ?? null) && !isset($data['href']) ? ['role' => 'button'] : []),
        ];
    }

    public function configureProps(OptionsResolver $resolver): void
    {
        $resolver
            ->setAllowedValues('color', ['accent', 'error', 'info', 'neutral', 'primary', 'secondary', 'success', 'warning'])
            ->setAllowedValues('shape', ['circle', 'square'])
            ->setAllowedValues('size', ['lg', 'md', 'sm', 'xl', 'xs'])
            ->setAllowedValues('variant', ['dash', 'ghost', 'link', 'outline', 'soft'])
        ;
    }
}
