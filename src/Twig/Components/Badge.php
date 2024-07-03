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
 * Badges are used to inform the user of the status of specific data.
 *
 * ```twig
 * <twig:Badge theme="primary" content="primary" />
 * ```
 *
 * ```twig
 * <twig:Badge theme="secondary" outline>
 *    secondary
 * </twig:Badge>
 * ```
 *
 * @package Core
 *
 * @link https://daisyui.com/components/badge/
 */
class Badge
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
     * The daisyUI theme.
     */
    public ?string $theme = null;

    /**
     * The size of the component (how large it will be displayed).
     */
    public ?string $size = null;

    /**
     * Whether the badge is shown outlined (transparent with border).
     */
    public ?bool $outline = false;
}
