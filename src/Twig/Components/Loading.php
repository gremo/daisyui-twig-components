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
 * Loading shows an animation to indicate that something is loading.
 *
 * ```twig
 * <twig:Loading shape="spinner" />
 * ```
 *
 * @package Core
 *
 * @link https://daisyui.com/components/loading/
 *
 * @see Progress
 * @see RadialProgress
 */
class Loading
{
    /**
     * The HTML tag to use for rendering.
     */
    public string $as = 'span';

    /**
     * The shape of the component ("spinner", "bars", etc.).
     */
    public ?string $shape = null;
}
