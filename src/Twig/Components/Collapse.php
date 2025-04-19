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

class Collapse implements ValidableComponentInterface
{
    public string $as = 'div';

    public ?string $icon = null;

    public bool $open = false;

    public ?string $title = null;

    public string $trigger = 'focus';

    public function configureProps(OptionsResolver $resolver): void
    {
        $resolver
            ->setAllowedValues('icon', ['arrow', 'plus'])
            ->setAllowedValues('trigger', ['click', 'focus'])
        ;
    }
}
