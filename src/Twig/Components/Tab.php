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
 * Represents a tab and can be used as a child of the `Tabs` component.
 *
 * ```twig
 * <twig:Tab as="button">
 *     Content 1
 * </twig:Tab>
 * ```
 *
 * @see Tabs
 */
class Tab
{
    /**
     * The HTML tag to use for rendering.
     */
    public string $as = 'a';

    /**
     * Whether the tab is active by default when the page loads.
     */
    public ?bool $active = false;
}
