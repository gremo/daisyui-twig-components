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
 * Tabs can be used to show a list of links in a tabbed format.
 *
 * Usage with links:
 *
 * ```twig
 * <twig:Tabs shape="lifted">
 *     <twig:Tab>Tab 1</twig:Tab>
 *     <twig:Tab active>Tab 2</twig:Tab>
 *     <twig:Tab>Tab 3</twig:Tab>
 * </twig:Tabs>
 * ```
 *
 * Usage with content (tab panels):
 *
 * ```twig
 * <twig:Tabs shape="boxed" size="sm">
 *     <twig:TabContent label="Tab 1" class="rounded-box p-6" active {{ ...tabAttributes }}>
 *         Content 1
 *     </twig:TabContent>
 *     <twig:TabContent label="Tab 2" class="rounded-box p-6" {{ ...tabAttributes }}>
 *         Content 2
 *     </twig:TabContent>
 * </twig:Tabs>
 * ```
 *
 * In order to work properly:
 *
 * - Requires the content to be bound with `tabAttributes`
 *
 * @package Core
 *
 * @link https://daisyui.com/components/tab/
 *
 * @see Tab
 * @see TabContent
 */
class Tabs
{
    /**
     * The unique identifier for the tabs (if omitted, one will be randomly generated).
     */
    public ?string $id = null;

    /**
     * The size of the component (how large it will be displayed).
     */
    public ?string $size = null;

    /**
     * The shape of the component ("boxed", "bordered", etc.).
     */
    public ?string $shape = null;

    public function mount(): void
    {
        $this->id ??= 'tabs-' . mt_rand();
    }

    #[ExposeInTemplate]
    public function getTabAttributes(): ComponentAttributes
    {
        return new ComponentAttributes(['tab' => $this->id]);
    }
}
