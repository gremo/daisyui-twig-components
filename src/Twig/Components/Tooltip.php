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
 * Tooltip can be used to show a message when hovering over an element.
 *
 * ```twig
 * <twig:Tooltip theme="primary" placement="right" tip="hello">
 *     <twig:Button>
 *         Hover me
 *     </twig:Button>
 * </twig:Tooltip>
 * ```
 *
 * @package Core
 *
 * @link https://daisyui.com/components/tooltip/
 */
class Tooltip
{
    /**
     * The text to show.
     */
    public string $tip;

    /**
     * The daisyUI theme to use.
     */
    public ?string $theme = null;

    /**
     * The position ("top", "bottom", etc.).
     */
    public ?string $placement = null;
}
