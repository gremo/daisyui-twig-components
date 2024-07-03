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
 * Represents a tab panel and can be used as a child of the `Tabs` component.
 *
 * ```twig
 * <twig:TabContent label="Tab 1" tab="my-tabs" class="rounded-box p-6">
 *     Content 1
 * </twig:TabContent>
 * ```
 *
 * @see Tabs
 */
class TabContent
{
    /**
     * The text to show as label.
     */
    public string $label;

    /**
     * The HTML ID of the tabs it refers to.
     */
    public string $tab;

    /**
     * Whether the tab is active by default when the page loads.
     */
    public ?bool $active = false;
}
