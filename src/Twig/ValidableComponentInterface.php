<?php

/*
 * This file is part of the daisyui-twig-components package.
 *
 * (c) Marco Polichetti <gremo1982@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Gremo\DaisyUITwigComponents\Twig;

use Symfony\Component\OptionsResolver\OptionsResolver;

interface ValidableComponentInterface
{
    public function configureProps(OptionsResolver $resolver): void;
}
