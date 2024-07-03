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

/**
 * Represents drawer content and can be used as a child of the `Drawer` component.
 *
 * ```twig
 * <twig:DrawerContent as="main" class="min-h-screen">
 *     Content 1
 * </twig:DrawerContent>
 * ```
 *
 * @see Drawer
 */
class DrawerContent
{
    /**
     * The HTML tag to use for rendering.
     */
    public string $as = 'div';
}
