<?php

namespace Gremo\DaisyUITwigComponents\Tests\Unit\Twig\Components;

use Gremo\DaisyUITwigComponents\Twig\Components\Dock;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\UX\TwigComponent\Test\InteractsWithTwigComponents;

class DockTest extends KernelTestCase
{
    use InteractsWithTwigComponents;

    public function testMount(): void
    {
        $component = $this->mountTwigComponent(
            name: 'Dock',
            data: [],
        );

        $this->assertInstanceOf(Dock::class, $component);
        $this->assertSame('div', $component->as);
        $this->assertNull($component->size);
    }

    public function testRenderWithoutData(): void
    {
        $rendered = $this->renderTwigComponent(
            name: 'Dock',
            data: [],
        );

        $body = $rendered->crawler()->children('body');
        $this->assertCount(1, $body->children());

        $el = $body->children()->first();
        $this->assertSame('div', $el->nodeName());
        $this->assertSame('dock', $el->attr('class'));
        $this->assertEmpty($el->innerText());
    }

    public function testRenderWithData(): void
    {
        $rendered = $this->renderTwigComponent(
            name: 'Dock',
            data: [
                'id' => 'my-dock',
                'class' => 'dock-custom',
                'data-controller' => 'controller',
            ],
        );

        $el = $rendered->crawler()->filter('body > *:first-child');

        $this->assertSame('my-dock', $el->attr('id'));
        $this->assertSame('dock dock-custom', $el->attr('class'));
        $this->assertSame('controller', $el->attr('data-controller'));
    }

    public function testAsProp(): void
    {
        $rendered = $this->renderTwigComponent(
            name: 'Dock',
            data: ['as' => 'nav'],
        );

        $this->assertSame('nav', $rendered->crawler()->filter('body > *:first-child')->nodeName());
    }

    public function testContentSlot(): void
    {
        $rendered = $this->renderTwigComponent(
            name: 'Dock',
            content: '<b>foo</b>'
        );

        $this->assertSame('<b>foo</b>', trim($rendered->crawler()->filter('body > *:first-child')->html()));
    }

    /**
     * @testWith ["lg", "dock-lg"]
     *           ["md", "dock-md"]
     *           ["sm", "dock-sm"]
     *           ["xl", "dock-xl"]
     *           ["xs", "dock-xs"]
     */
    public function testSizeProp(string $value, string $expectedCssClass): void
    {
        $rendered = $this->renderTwigComponent(
            name: 'Dock',
            data: ['size' => $value],
        );

        $this->assertSame("dock $expectedCssClass", $rendered->crawler()->filter('body > *:first-child')->attr('class'));
    }

    public function testInvalidSizePropThrows(): void
    {
        $this->expectException(\Twig\Error\RuntimeError::class);
        $this->expectExceptionMessageMatches('/option "size" with value "foo" is invalid/i');

        $this->renderTwigComponent(
            name: 'Dock',
            data: ['size' => 'foo'],
        );
    }
}
