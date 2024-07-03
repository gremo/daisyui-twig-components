<?php

namespace Gremo\DaisyUITwigComponents\Tests\Unit\Twig\Components;

use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\UX\TwigComponent\Test\InteractsWithTwigComponents;

class TooltipTest extends KernelTestCase
{
    use InteractsWithTwigComponents;

    public function testRenderingWithDefaults(): void
    {
        $rendered = $this->renderTwigComponent(
            name: 'Tooltip',
            data: ['tip' => 'foo'],
        );

        $body = $rendered->crawler()->children('body');
        $this->assertCount(1, $body->children());

        $el = $body->children()->first();
        $this->assertSame('div', $el->nodeName());
        $this->assertSame('tooltip', $el->attr('class'));
    }

    public function testCanRenderContent(): void
    {
        $rendered = $this->renderTwigComponent(
            name: 'Tooltip',
            data: ['tip' => 'foo'],
            content: 'bar',
        );

        $el = $rendered->crawler()->filter('body > *:first-child');
        $this->assertStringContainsString('bar', $el->html());
    }

    public function testCanRenderAttributes(): void
    {
        $rendered = $this->renderTwigComponent(
            name: 'Tooltip',
            data: ['tip' => 'foo', 'foo' => 'bar'],
        );

        $el = $rendered->crawler()->filter('body > *:first-child');
        $this->assertSame('bar', $el->attr('foo'));
    }

    /**
     * @testWith [null, "tooltip"]
     *           ["", "tooltip"]
     *           ["primary", "tooltip tooltip-primary"]
     *           ["secondary", "tooltip tooltip-secondary"]
     *           ["accent", "tooltip tooltip-accent"]
     *           ["info", "tooltip tooltip-info"]
     *           ["success", "tooltip tooltip-success"]
     *           ["warning", "tooltip tooltip-warning"]
     *           ["error", "tooltip tooltip-error"]
     */
    public function testThemeProp(?string $value, string $expectedCass): void
    {
        $rendered = $this->renderTwigComponent(
            name: 'Tooltip',
            data: ['tip' => 'foo', 'theme' => $value],
        );

        $el = $rendered->crawler()->filter('body > *:first-child');
        $this->assertSame($expectedCass, $el->attr('class'));
    }

    /**
     * @testWith [null, "tooltip"]
     *           ["", "tooltip"]
     *           ["top", "tooltip tooltip-top"]
     *           ["bottom", "tooltip tooltip-bottom"]
     *           ["left", "tooltip tooltip-left"]
     *           ["right", "tooltip tooltip-right"]
     */
    public function testPlacementProp(?string $value, string $expectedCass): void
    {
        $rendered = $this->renderTwigComponent(
            name: 'Tooltip',
            data: ['tip' => 'foo', 'placement' => $value],
        );

        $el = $rendered->crawler()->filter('body > *:first-child');
        $this->assertSame($expectedCass, $el->attr('class'));
    }
}
