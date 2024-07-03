<?php

namespace Gremo\DaisyUITwigComponents\Tests\Unit\Twig\Components;

use Gremo\DaisyUITwigComponents\Twig\Components\Drawer;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\UX\TwigComponent\ComponentAttributes;
use Symfony\UX\TwigComponent\Test\InteractsWithTwigComponents;

class DrawerTest extends KernelTestCase
{
    use InteractsWithTwigComponents;

    public function testRenderingWithDefaults(): void
    {
        $rendered = $this->renderTwigComponent(
            name: 'Drawer',
            data: [],
        );

        $body = $rendered->crawler()->children('body');
        $this->assertCount(1, $body->children());

        $el = $body->children()->first();
        $this->assertSame('div', $el->nodeName());
        $this->assertSame('drawer', $el->attr('class'));

        $input = $el->children()->first();
        $this->assertStringStartsWith('drawer-', $input->attr('id'));
        $this->assertSame('input', $input->nodeName());
        $this->assertSame('checkbox', $input->attr('type'));
        $this->assertSame('drawer-toggle', $input->attr('class'));
    }

    public function testCanRenderContent(): void
    {
        $rendered = $this->renderTwigComponent(
            name: 'Drawer',
            content: '<b>foo</b>',
        );

        $el = $rendered->crawler()->filter('.drawer');
        $this->assertStringContainsString('<b>foo</b>', $el->html());
    }

    public function testCanRenderAttributes(): void
    {
        $rendered = $this->renderTwigComponent(
            name: 'Drawer',
            data: ['foo' => 'bar'],
        );

        $el = $rendered->crawler()->filter('.drawer');
        $this->assertSame('bar', $el->attr('foo'));
    }

    /**
     * @testWith [null]
     *           ["foo"]
     */
    public function testSideAttributes(?string $value): void
    {
        $drawer = new Drawer();
        if (null !== $value) {
            $drawer->id = $value;
        }
        $drawer->mount();

        $attrs = $drawer->getSideAttributes();
        $this->assertInstanceOf(ComponentAttributes::class, $attrs);
        $this->assertSame($drawer->id, $attrs->render('for'));
    }

    /**
     * @testWith [null]
     *           ["foo"]
     */
    public function testButtonAttributes(?string $value): void
    {
        $drawer = new Drawer();
        if (null !== $value) {
            $drawer->id = $value;
        }
        $drawer->mount();

        $attrs = $drawer->getButtonAttributes();
        $this->assertInstanceOf(ComponentAttributes::class, $attrs);
        $this->assertSame('label', $attrs->render('as'));
        $this->assertSame($drawer->id, $attrs->render('for'));
    }
}
