<?php

namespace Gremo\DaisyUITwigComponents\Tests\Unit\Twig\Components;

use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\UX\TwigComponent\Test\InteractsWithTwigComponents;

class DrawerContentTest extends KernelTestCase
{
    use InteractsWithTwigComponents;

    public function testRenderingWithDefaults(): void
    {
        $rendered = $this->renderTwigComponent(
            name: 'DrawerContent',
        );

        $body = $rendered->crawler()->children('body');
        $this->assertCount(1, $body->children());

        $el = $body->children()->first();
        $this->assertSame('div', $el->nodeName());
        $this->assertSame('drawer-content', $el->attr('class'));
    }

    public function testCanRenderContent(): void
    {
        $rendered = $this->renderTwigComponent(
            name: 'DrawerContent',
            content: '<b>foo</b>',
        );

        $el = $rendered->crawler()->filter('.drawer-content');
        $this->assertStringContainsString('<b>foo</b>', $el->html());
    }

    public function testCanRenderAttributes(): void
    {
        $rendered = $this->renderTwigComponent(
            name: 'DrawerContent',
            data: [
                'foo' => 'bar',
            ],
        );

        $el = $rendered->crawler()->filter('.drawer-content');
        $this->assertSame('bar', $el->attr('foo'));
    }

    public function testAsProp(): void
    {
        $rendered = $this->renderTwigComponent(
            name: 'DrawerContent',
            data: [
                'as' => 'main',
            ],
        );

        $el = $rendered->crawler()->filter('.drawer-content');
        $this->assertSame('main', $el->nodeName());
    }
}
