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
 * Represents drawer side and can be used as a child of the `Drawer` component.
 *
 * ```twig
 * <twig:DrawerSide drawer="my-drawer">
 *     Side content
 * </twig:DrawerSide>
 * ```
 * - Supports nested attributes for the overlay
 *
 * @see Drawer
 */
class DrawerSide
{
    /**
     * The HTML tag to use for rendering.
     */
    public string $as = 'div';

    /**
     * The HTML ID of the drawer it refers to.
     */
    public string $drawer;
}
