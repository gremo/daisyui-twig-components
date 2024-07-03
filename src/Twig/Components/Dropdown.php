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
 * Dropdown can open a menu or any other element when the button is clicked.
 *
 * ```twig
 * <twig:Dropdown>
 *     <twig:Button {{ ...this.triggerAttributes }}>
 *         Click to open
 *     </twig:Button>
 *
 *     <twig:DropdownContent
 *         as="ul"
 *         class="menu bg-base-100 rounded-box z-[1] w-52 p-2 shadow" {{ ...contentAttributes }}
 *     >
 *         <li><a>Item 1</a></li>
 *         <li><a>Item 2</a></li>
 *     </twig:DropdownContent>
 * </twig:Dropdown>
 * ```
 *
 * In order to work properly:
 *
 * - Requires the trigger to be a component with `as` prop bound using `triggerAttributes`
 * - Requires the content to be a component with `as` prop bound using `contentAttributes`
 *
 * @package Core
 *
 * @link https://daisyui.com/components/dropdown/
 *
 * @see Button
 * @see DropdownContent
 */
class Dropdown
{
    /**
     * Sets the trigger mode ("click", "focus" or "hover")
     */
    public string $trigger = 'focus';

    /**
     * The placement ("top", "right", etc.)
     */
    public ?string $placement = null;

    /**
     * The alignment ("start", "end", etc.)
     */
    public ?string $align = null;

    public function getAs(): string
    {
        return match ($this->trigger) {
            'click' => 'details',
            default => 'div',
        };
    }

    #[ExposeInTemplate]
    public function getTriggerAttributes(): ComponentAttributes
    {
        return new ComponentAttributes(match ($this->trigger) {
            'click' => [
                'as' => 'summary',
            ],
            'focus', 'hover' => [
                'as' => 'div',
                'role' => 'button',
                'tabindex' => '0',
            ],
            default => [],
        });
    }

    #[ExposeInTemplate]
    public function getContentAttributes(): ComponentAttributes
    {
        return new ComponentAttributes(match ($this->trigger) {
            'focus', 'hover' => [
                'tabindex' => '0',
            ],
            default => [],
        });
    }
}
