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
 * Progress bar can be used to show the progress of a task or to show the passing of time.
 *
 * Progress with a `value` and a `max`:
 *
 * ```twig
 * <twig:Progress value="75" max="100" />
 * ```
 *
 * Indeterminate progress:
 *
 * ```twig
 * <twig:Progress theme="primary" />
 * ```
 *
 * @package Core
 *
 * @link https://daisyui.com/components/progress/
 *
 * @see Loading
 * @see RadialProgress
 */
class Progress
{
    /**
     * The daisyUI theme to use.
     */
    public ?string $theme = null;
}
