<?php

namespace Gremo\DaisyUITwigComponents\Tests\Unit\Twig\Components;

use Gremo\DaisyUITwigComponents\Twig\Components\Tabs;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\UX\TwigComponent\ComponentAttributes;
use Symfony\UX\TwigComponent\Test\InteractsWithTwigComponents;

class TabsTest extends KernelTestCase
{
    use InteractsWithTwigComponents;

    public function testRenderingWithDefaults(): void
    {
        $rendered = $this->renderTwigComponent(
            name: 'Tabs',
            data: [],
        );

        $body = $rendered->crawler()->children('body');
        $this->assertCount(1, $body->children());

        $el = $body->children()->first();
        $this->assertSame('div', $el->nodeName());
        $this->assertSame('tabs', $el->attr('class'));
        $this->assertSame('tablist', $el->attr('role'));
    }

    public function testCanRenderContent(): void
    {
        $rendered = $this->renderTwigComponent(
            name: 'Tabs',
            content: '<b>foo</b>',
        );

        $el = $rendered->crawler()->filter('body > *:first-child');
        $this->assertStringContainsString('<b>foo</b>', $el->html());
    }

    public function testCanRenderAttributes(): void
    {
        $rendered = $this->renderTwigComponent(
            name: 'Tabs',
            data: ['foo' => 'bar'],
        );

        $el = $rendered->crawler()->filter('body > *:first-child');
        $this->assertSame('bar', $el->attr('foo'));
    }

    public function testCannotChangeFixedAttributes(): void
    {
        $rendered = $this->renderTwigComponent(
            name: 'Tabs',
            data: ['role' => 'foo'],
        );

        $el = $rendered->crawler()->filter('body > *:first-child');
        $this->assertSame('tablist', $el->attr('role'));
    }

    /**
     * @testWith [null, "tabs"]
     *           ["", "tabs"]
     *           ["lg", "tabs tabs-lg"]
     *           ["md", "tabs tabs-md"]
     *           ["sm", "tabs tabs-sm"]
     *           ["xs", "tabs tabs-xs"]
     */
    public function testSizeProp(?string $value, string $expectedCass): void
    {
        $rendered = $this->renderTwigComponent(
            name: 'Tabs',
            data: ['size' => $value],
        );

        $el = $rendered->crawler()->filter('body > *:first-child');
        $this->assertSame($expectedCass, $el->attr('class'));
    }

    /**
     * @testWith [null, "tabs"]
     *           ["", "tabs"]
     *           ["boxed", "tabs tabs-boxed"]
     *           ["bordered", "tabs tabs-bordered"]
     *           ["lifted", "tabs tabs-lifted"]
     */
    public function testShapeProp(?string $value, string $expectedCass): void
    {
        $rendered = $this->renderTwigComponent(
            name: 'Tabs',
            data: ['shape' => $value],
        );

        $el = $rendered->crawler()->filter('body > *:first-child');
        $this->assertSame($expectedCass, $el->attr('class'));
    }

    /**
     * @testWith [null]
     *           ["foo"]
     */
    public function testTabAttributes(?string $value): void
    {
        $tabs = new Tabs();
        if (null !== $value) {
            $tabs->id = $value;
        }
        $tabs->mount();

        $attrs = $tabs->getTabAttributes();
        $this->assertInstanceOf(ComponentAttributes::class, $attrs);
        $this->assertNotNull($tabs->id);
        $this->assertTrue($attrs->has('tab'));
        $this->assertSame($tabs->id, $attrs->render('tab'));
    }
}
