<?php

namespace Gremo\DaisyUITwigComponents\Tests\Unit\Twig\Components;

use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\UX\TwigComponent\Test\InteractsWithTwigComponents;

class DrawerSideTest extends KernelTestCase
{
    use InteractsWithTwigComponents;

    public function testRenderingWithDefaults(): void
    {
        $rendered = $this->renderTwigComponent(
            name: 'DrawerSide',
            data: ['for' => 'my-drawer'],
        );

        $body = $rendered->crawler()->children('body');
        $this->assertCount(1, $body->children());

        $el = $body->children()->first();
        $this->assertSame('div', $el->nodeName());
        $this->assertSame('drawer-side', $el->attr('class'));

        $overlay = $el->children()->first();
        $this->assertSame('label', $overlay->nodeName());
        $this->assertSame('drawer-overlay', $overlay->attr('class'));
        $this->assertSame('my-drawer', $overlay->attr('for'));
    }

    public function testCanRenderContent(): void
    {
        $rendered = $this->renderTwigComponent(
            name: 'DrawerSide',
            data: ['for' => 'my-drawer'],
            content: 'bar',
        );

        $el = $rendered->crawler()->filter('.drawer-side');
        $this->assertStringContainsString('bar', $el->html());
    }

    public function testCanRenderAttributes(): void
    {
        $rendered = $this->renderTwigComponent(
            name: 'DrawerSide',
            data: [
                'for' => 'my-drawer',
                'bar' => 'baz',
            ],
        );

        $el = $rendered->crawler()->filter('.drawer-side');
        $this->assertSame('baz', $el->attr('bar'));
    }

    public function testCannotChangeFixedAttributes(): void
    {
        $rendered = $this->renderTwigComponent(
            name: 'DrawerSide',
            data: [
                'for' => 'my-drawer',
                'overlay:for' => 'foo',
            ],
        );

        $overlay = $rendered->crawler()->filter('.drawer-overlay');
        $this->assertNotSame('foo', $overlay->attr('role'));
    }

    public function testCanRenderNestedAttributes(): void
    {
        $rendered = $this->renderTwigComponent(
            name: 'DrawerSide',
            data: [
                'for' => 'my-drawer',
                'overlay:class' => 'foo',
                'overlay:bar' => 'baz',
            ],
        );

        $overlay = $rendered->crawler()->filter('.drawer-overlay');
        $this->assertStringContainsString('foo', $overlay->attr('class'));
        $this->assertSame('baz', $overlay->attr('bar'));
    }

    public function testAsProp(): void
    {
        $rendered = $this->renderTwigComponent(
            name: 'DrawerSide',
            data: [
                'for' => 'my-drawer',
                'as' => 'aside',
            ],
        );

        $side = $rendered->crawler()->filter('.drawer-side');
        $this->assertSame('aside', $side->nodeName());
    }

    public function testForPropMissing(): void
    {
        $this->expectException(\Twig\Error\RuntimeError::class);
        $this->expectExceptionMessage('Variable "for" does not exist');

        $this->renderTwigComponent(
            name: 'DrawerSide',
        );
    }
}
