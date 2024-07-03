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
 * Radial progress can be used to show the progress of a task or to show the passing of time.
 *
 * ```twig
 * <twig:RadialProgress value="75" />
 * ```
 *
 * With a custom content, size and thickness:
 *
 * ```twig
 * <twig:RadialProgress value="80.5" content="80%" size="10rem" thickness="0.25rem" />
 * ```
 *
 * @package Core
 *
 * @link https://daisyui.com/components/radial-progress/
 *
 * @see Loading
 * @see Progress
 */
class RadialProgress
{
    /**
     * The value to show.
     */
    public float $value;

    /**
     * The size of the component (CSS unit).
     */
    public ?string $size = null;

    /**
     * The thickness of the component (CSS unit).
     */
    public ?string $thickness = null;

    /**
     * The content (used when the block is not present).
     */
    public ?string $content = null;
}
