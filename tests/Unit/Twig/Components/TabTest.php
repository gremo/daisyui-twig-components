<?php

namespace Gremo\DaisyUITwigComponents\Tests\Unit\Twig\Components;

use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\UX\TwigComponent\Test\InteractsWithTwigComponents;

class TabTest extends KernelTestCase
{
    use InteractsWithTwigComponents;

    public function testRenderingWithDefaults(): void
    {
        $rendered = $this->renderTwigComponent(
            name: 'Tab',
        );

        $body = $rendered->crawler()->children('body');
        $this->assertCount(1, $body->children());

        $el = $body->children()->first();
        $this->assertSame('a', $el->nodeName());
        $this->assertSame('tab', $el->attr('class'));
        $this->assertSame('tab', $el->attr('role'));
    }

    public function testCanRenderContent(): void
    {
        $rendered = $this->renderTwigComponent(
            name: 'Tab',
            content: '<b>foo</b>',
        );

        $el = $rendered->crawler()->filter('.tab');
        $this->assertStringContainsString('<b>foo</b>', $el->html());
    }

    public function testCanRenderAttributes(): void
    {
        $rendered = $this->renderTwigComponent(
            name: 'Tab',
            data: [
                'foo' => 'bar',
            ],
        );

        $el = $rendered->crawler()->filter('.tab');
        $this->assertSame('bar', $el->attr('foo'));
    }

    public function testCannotChangeFixedAttributes(): void
    {
        $rendered = $this->renderTwigComponent(
            name: 'Tab',
            data: [
                'role' => 'baz',
            ],
        );

        $el = $rendered->crawler()->filter('.tab');
        $this->assertNotSame('baz', $el->attr('role'));
    }

    public function testAsProp(): void
    {
        $rendered = $this->renderTwigComponent(
            name: 'Tab',
            data: ['as' => 'button']
        );

        $el = $rendered->crawler()->filter('.tab');
        $this->assertSame('button', $el->nodeName());
    }

    /**
     * @testWith [null, "tab"]
     *           [false, "tab"]
     *           [true, "tab tab-active"]
     */
    public function testActiveProp(?bool $value, ?string $expectedClass): void
    {
        $rendered = $this->renderTwigComponent(
            name: 'Tab',
            data: [
                'active' => $value,
            ],
        );

        $el = $rendered->crawler()->filter('.tab');
        $this->assertStringContainsString($expectedClass, $el->attr('class'));
    }
}
