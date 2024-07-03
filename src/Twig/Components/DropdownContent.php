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
 * Represents dropdown content and can be used as a child of the `Dropdown` component.
 *
 * ```twig
 * <twig:DropdownContent class="card card-compact bg-primary text-primary-content z-[1] w-64 p-2 shadow">
 *     <div class="card-body">
 *         <h3 class="card-title">Card title!</h3>
 *         <p>you can use any element as a dropdown.</p>
 *     </div>
 * </twig:DrawerContent>
 * ```
 *
 * @see Dropdown
 */
class DropdownContent
{
    /**
     * The HTML tag to use for rendering.
     */
    public string $as = 'div';
}
