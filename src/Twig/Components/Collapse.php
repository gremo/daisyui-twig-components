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
 * Collapse is used for showing and hiding content.
 *
 * Short usage form:
 *
 * ```twig
 * <twig:Collapse title="Focus me to see content" autoClose>
 *    Collapse content here!
 * </twig:Collapse>
 * ```
 * Usage with blocks:
 *
 * ```twig
 * <twig:Collapse>
 *     <twig:block name="title">
 *        <b>Click</b> me to show/hide content
 *     </twig:block>
 *
 *     Collapse content here!
 * </twig:Collapse>
 * ```
 *
 * - Supports nested attributes for title and content.
 *
 * @package Core
 *
 * @link https://daisyui.com/components/collapse/
 */
class Collapse
{
    /**
     * The title of the collapse (used when the block is not present).
     */
    public ?string $title = null;

    /**
     * The icon type to use ("arrow" or "plus").
     */
    public ?string $icon = null;

    /**
     * Whether the collapse will close when it loses focus.
     */
    public bool $autoClose = false;
}
