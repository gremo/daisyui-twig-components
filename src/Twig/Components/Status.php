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

class Status implements ValidableComponentInterface
{
    public string $as = 'span';

    public ?string $color = null;

    public ?string $size = null;

    public function configureProps(OptionsResolver $resolver): void
    {
        $resolver
            ->setAllowedValues('color', ['accent', 'error', 'info', 'neutral', 'primary', 'secondary', 'success', 'warning'])
            ->setAllowedValues('size', ['lg', 'md', 'sm', 'xl', 'xs'])
        ;
    }
}
