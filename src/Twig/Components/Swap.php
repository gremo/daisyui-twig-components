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
 *
 *
 * Swap allows you to toggle the visibility of two elements using a checkbox or a class name.
 *
 * ```twig
 * <twig:Swap on="ON" off="OFF" on:class="text-success" off:class="text-error" />
 * ```
 *
 * ```twig
 * <twig:Swap class="text-4xl" active>
 *     <twig:block name="on">
 *         🥳 Happy
 *     </twig:block>
 *     <twig:block name="off">
 *         😭 Sad
 *     </twig:block>
 * </twig:Swap>
 * ```
 *
 * @package Core
 *
 * @link https://daisyui.com/components/swap/
 */
class Swap
{
    /**
     * The "on" content of the swap (used when the block is not present).
     */
    public ?string $on = null;

    /**
     * The "off" content of the swap (used when the block is not present).
     */
    public ?string $off = null;

    /**
     * The effect to use ("rotate", "flip", etc.).
     */
    public ?string $effect = null;

    /**
     * Whether the swap is active when the page loads.
     */
    public ?bool $active = null;
}
