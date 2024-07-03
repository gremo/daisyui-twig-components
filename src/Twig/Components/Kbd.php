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
 * Kbd is used to display keyboard shortcuts.
 *
 * ```twig
 * <twig:Kbd content="A" />
 * ```
 *
 * ```twig
 * <twig:Kbd size="sm">
 *    B
 * </twig:Kbd>
 * ```
 *
 * @package Core
 *
 * @link https://daisyui.com/components/kbd/
 */
class Kbd
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
     * The size of the component (how large it will be displayed).
     */
    public ?string $size = null;
}
