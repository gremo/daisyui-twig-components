<?php

namespace Gremo\DaisyUITwigComponents\Tests\Unit\Twig\Components;

use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\UX\TwigComponent\Test\InteractsWithTwigComponents;

class SwapTest extends KernelTestCase
{
    use InteractsWithTwigComponents;

    public function testRenderingWithDefaults(): void
    {
        $rendered = $this->renderTwigComponent(
            name: 'Swap',
            data: [],
        );

        $body = $rendered->crawler()->children('body');
        $this->assertCount(1, $body->children());

        $el = $body->children()->first();
        $this->assertSame('label', $el->nodeName());
        $this->assertSame('swap', $el->attr('class'));

        $checkbox = $el->children()->first();
        $this->assertSame('input', $checkbox->nodeName());
        $this->assertSame('checkbox', $checkbox->attr('type'));

        $swapOn = $checkbox->nextAll()->first();
        $this->assertSame('div', $swapOn->nodeName());
        $this->assertSame('swap-on', $swapOn->attr('class'));

        $swappOff = $swapOn->nextAll()->first();
        $this->assertSame('div', $swappOff->nodeName());
        $this->assertSame('swap-off', $swappOff->attr('class'));
    }

    /**
     * @testWith ["foo", "foo"]
     */
    public function testCannotRenderContent(string $value, string $expectedContent): void
    {
        $rendered = $this->renderTwigComponent(
            name: 'Swap',
            content: $value,
        );

        $el = $rendered->crawler()->filter('body > *:first-child');
        $this->assertStringNotContainsString($expectedContent, $el->html());
    }

    public function testCanRenderAttributes(): void
    {
        $rendered = $this->renderTwigComponent(
            name: 'Swap',
            data: ['foo' => 'bar'],
        );

        $el = $rendered->crawler()->filter('body > *:first-child');
        $this->assertSame('bar', $el->attr('foo'));
    }

    public function testCanRenderNestedAttributes(): void
    {
        $rendered = $this->renderTwigComponent(
            name: 'Swap',
            data: [
                'on:class' => 'bar',
                'on:foo' => 'bar',
                'off:class' => 'baz',
                'off:bar' => 'baz',
            ],
        );

        $el = $rendered->crawler()->filter('body > *:first-child');

        $on = $el->children('.swap-on');
        $this->assertStringContainsString('bar', $on->attr('class'));
        $this->assertSame('bar', $on->attr('foo'));

        $off = $el->children('.swap-off');
        $this->assertStringContainsString('baz', $off->attr('class'));
        $this->assertSame('baz', $off->attr('bar'));
    }

    /**
     * @testWith [{"block": "foo"}, "foo"]
     *           [{"data": {"on": "foo"}}, "foo"]
     */
    public function testCanRenderOn(array $data, string $expectedContent): void
    {
        $rendered = $this->renderTwigComponent(
            name: 'Swap',
            data: $data['data'] ?? [],
            blocks: [
                'on' => $data['block'] ?? null,
            ]
        );

        $el = $rendered->crawler()->filter('body > *:first-child');

        $on = $el->children('.swap-on');
        $this->assertStringContainsString($expectedContent, $on->html());
    }

    /**
     * @testWith [{"block": "foo"}, "foo"]
     *           [{"data": {"off": "foo"}}, "foo"]
     */
    public function testCanRenderOff(array $data, string $expectedContent): void
    {
        $rendered = $this->renderTwigComponent(
            name: 'Swap',
            data: $data['data'] ?? [],
            blocks: [
                'off' => $data['block'] ?? null,
            ]
        );

        $el = $rendered->crawler()->filter('body > *:first-child');

        $on = $el->children('.swap-off');
        $this->assertStringContainsString($expectedContent, $on->html());
    }

    /**
     * @testWith [null, "swap"]
     *           ["", "swap"]
     *           ["rotate", "swap swap-rotate"]
     *           ["flip", "swap swap-flip"]
     */
    public function testEffectProp(?string $value, string $expectedCass): void
    {
        $rendered = $this->renderTwigComponent(
            name: 'Swap',
            data: ['effect' => $value],
        );

        $el = $rendered->crawler()->filter('body > *:first-child');
        $this->assertSame($expectedCass, $el->attr('class'));
    }

    /**
     * @testWith [null, null]
     *           [false, null]
     *           [true, "checked"]
     */
    public function testActiveProp(?bool $value, ?string $expectedCheckedAttr): void
    {
        $rendered = $this->renderTwigComponent(
            name: 'Swap',
            data: ['active' => $value],
        );

        $el = $rendered->crawler()->filter('body > *:first-child');

        $checkbox = $el->children()->first();
        $this->assertSame($expectedCheckedAttr, $checkbox->attr('checked'));
    }
}
