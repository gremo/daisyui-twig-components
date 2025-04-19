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

class Toast implements ValidableComponentInterface
{
    public string $as;

    public ?string $align = null;

    public ?string $placement = null;

    public function configureProps(OptionsResolver $resolver): void
    {
        $resolver
            ->setAllowedValues('align', ['center', 'end', 'start'])
            ->setAllowedValues('placement', ['bottom', 'left', 'right', 'top'])
        ;
    }
}
