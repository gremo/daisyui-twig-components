<?php

namespace Gremo\DaisyUITwigComponents\Tests\Unit\Twig\Components;

use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\UX\TwigComponent\Test\InteractsWithTwigComponents;

class DockItemTest extends KernelTestCase
{
    use InteractsWithTwigComponents;

    public function testRenderWithoutData(): void
    {
        $rendered = $this->renderTwigComponent(
            name: 'DockItem',
            data: [],
        );

        $body = $rendered->crawler()->children('body');
        $this->assertCount(1, $body->children());

        $el = $body->children()->first();
        $this->assertSame('button', $el->nodeName());
        $this->assertEmpty($el->innerText());
    }

    public function testRenderWithData(): void
    {
        $rendered = $this->renderTwigComponent(
            name: 'DockItem',
            data: [
                'id' => 'my-dockitem',
                'class' => 'dockitem-custom',
                'data-controller' => 'dockitem',
            ],
        );

        $el = $rendered->crawler()->filter('body > *:first-child');

        $this->assertSame('my-dockitem', $el->attr('id'));
        $this->assertSame('dockitem-custom', $el->attr('class'));
        $this->assertSame('dockitem', $el->attr('data-controller'));
    }

    public function testAsProp(): void
    {
        $rendered = $this->renderTwigComponent(
            name: 'DockItem',
            data: ['as' => 'div'],
        );

        $el = $rendered->crawler()->filter('body > *:first-child');

        $this->assertSame('div', $el->nodeName());
    }

    /**
     * @testWith [false, null]
     *           [true, "dock-active"]
     */
    public function testActiveProp(?bool $value, ?string $expectedCssClass): void
    {
        $rendered = $this->renderTwigComponent(
            name: 'DockItem',
            data: ['active' => $value],
        );

        $el = $rendered->crawler()->filter('body > *:first-child');

        $this->assertSame($expectedCssClass, $el->attr('class'));
        $this->assertSame($value ? 'true' : null, $el->attr('aria-current'));
    }

    /**
     * @testWith [true, "true"]
     *           ["page", "page"]
     */
    public function testCurrentProp(mixed $value, ?string $expectedAttrValue): void
    {
        $rendered = $this->renderTwigComponent(
            name: 'DockItem',
            data: [
                'active' => true,
                'current' => $value,
            ],
        );

        $el = $rendered->crawler()->filter('body > *:first-child');

        $this->assertSame($expectedAttrValue, $el->attr('aria-current'));
    }

    public function testLabelProp(): void
    {
        $rendered = $this->renderTwigComponent(
            name: 'DockItem',
            data: [
                'label' => 'foo',
            ],
        );

        $el = $rendered->crawler()->filter('body > *:first-child');

        $label = $el->children()->last();

        $this->assertSame('foo', $label->innerText());
        $this->assertSame('dock-label', $label->attr('class'));
    }

    public function testLabelNestedAttributes(): void
    {
        $rendered = $this->renderTwigComponent(
            name: 'DockItem',
            data: [
                'label' => 'foo',
                'label:id' => 'my-label',
                'label:class' => 'label-custom',
            ],
        );

        $el = $rendered->crawler()->filter('body > *:first-child');

        $label = $el->children()->last();

        $this->assertSame('foo', $label->innerText());
        $this->assertSame('my-label', $label->attr('id'));
        $this->assertSame('dock-label label-custom', $label->attr('class'));
    }

    public function testContentSlot(): void
    {
        $rendered = $this->renderTwigComponent(
            name: 'DockItem',
            content: '<b>foo</b>',
        );

        $el = $rendered->crawler()->filter('body > *:first-child');

        $this->assertSame('<b>foo</b>', trim($el->children()->last()->outerHtml()));
    }
}
