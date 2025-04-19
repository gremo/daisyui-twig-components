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

class Alert implements ValidableComponentInterface
{
    public string $as = 'div';

    public ?string $content = null;

    public ?string $color = null;

    public ?string $direction = null;

    public ?string $variant = null;

    public function configureProps(OptionsResolver $resolver): void
    {
        $resolver
            ->setAllowedValues('color', ['error', 'info', 'success', 'warning'])
            ->setAllowedValues('direction', ['horizontal', 'vertical'])
            ->setAllowedValues('variant', ['dash', 'outline', 'soft'])
        ;
    }
}
