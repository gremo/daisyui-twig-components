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

use Symfony\UX\TwigComponent\Attribute\ExposeInTemplate;
use Symfony\UX\TwigComponent\ComponentAttributes;

/**
 * Drawer is a grid layout that can show/hide a sidebar on the left or right side of the page.
 *
 * ```twig
 * <twig:Drawer>
 *     <twig:DrawerContent>
 *         <!-- page content -->
 *         <twig:Button content="Open drawer" {{ ...buttonAttributes }} />
 *     </twig:DrawerContent>
 *
 *     <twig:DrawerSide {{ ...sideAttributes }}>
 *         <div class="min-h-full w-80 bg-base-200 p-4">
 *             <!-- side content -->
 *         </div>
 *     </twig:DrawerSide>
 * </twig:Drawer>
 * ```
 * In order to work properly:
 *
 * - Requires the button to be a component with `as` prop and to be bound using `buttonAttributes`
 * - Requires the side to be bound using`sideAttributes`
 *
 * @package Core
 *
 * @link https://daisyui.com/components/drawer/
 *
 * @see DrawerContent
 * @see DrawerSide
 */
class Drawer
{
    /**
     * The unique identifier for the drawer (if omitted, one will be randomly generated).
     */
    public string $id;

    /**
     * The HTML tag to use for rendering.
     */
    public string $as = 'div';

    public function mount(): void
    {
        $this->id ??= 'drawer-' . mt_rand();
    }

    #[ExposeInTemplate]
    public function getSideAttributes(): ComponentAttributes
    {
        return new ComponentAttributes([
            'for' => $this->id,
        ]);
    }

    #[ExposeInTemplate]
    public function getButtonAttributes(): ComponentAttributes
    {
        return new ComponentAttributes([
            'as' => 'label',
            'for' => $this->id,
        ]);
    }
}
