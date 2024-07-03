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
 * Buttons allow the user to take actions or make choices.
 *
 * ```twig
 * <twig:Button theme="success" content="Click me" outline />
 * ```
 *
 * ```twig
 * <twig:Button theme="grass" size="sm">
 *     Glass button
 * </twig:Button>
 * ```
 *
 * @package Core
 *
 * @link https://daisyui.com/components/button/
 */
class Button
{
    /**
     * The HTML tag to use for rendering.
     */
    public string $as = 'button';

    /**
     * The daisyUI theme.
     */
    public ?string $theme = null;

    /**
     * The content (used when the block is not present).
     */
    public ?string $content = null;

    /**
     * The size of the component (how large it will be displayed).
     */
    public ?string $size = null;

    /**
     * The shape of the component ("circle", "square", etc.).
     */
    public ?string $shape = null;

    /**
     * Whether is shown with active state.
     */
    public ?bool $active = false;

    /**
     * Whether is shown full width button.
     */
    public ?bool $block = false;

    /**
     * Whether to disable the click animation.
     */
    public ?bool $noAnimation = false;

    /**
     * Whether is shown outlined (transparent with border).
     */
    public ?bool $outline = false;

    /**
     * Whether is shown wider (more horizontal padding).
     */
    public ?bool $wide = false;
}
