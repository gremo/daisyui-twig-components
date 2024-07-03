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
 * Alert informs users about important events.
 *
 * ```twig
 * <twig:Alert theme="error" content="An error occurred." />
 * ```
 *
 * ```twig
 * <twig:Alert theme="info">
 *    New <b>software update</b> available.
 * </twig:Alert>
 * ```
 *
 * @package Core
 *
 * @link https://daisyui.com/components/alert/
 */
class Alert
{
    /**
     * The HTML tag to use for rendering.
     */
    public string $as = 'div';

    /**
     * The content (used when the block is not present).
     */
    public ?string $content = null;

    /**
     * The daisyUI theme to use.
     */
    public ?string $theme = null;
}
