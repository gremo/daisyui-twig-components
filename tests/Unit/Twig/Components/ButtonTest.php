<?php

namespace Gremo\DaisyUITwigComponents\Tests\Unit\Twig\Components;

use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\UX\TwigComponent\Test\InteractsWithTwigComponents;

class ButtonTest extends KernelTestCase
{
    use InteractsWithTwigComponents;

    public function testRenderingWithDefaults(): void
    {
        $rendered = $this->renderTwigComponent(
            name: 'Button',
            data: [],
        );

        $body = $rendered->crawler()->children('body');
        $this->assertCount(1, $body->children());

        $el = $body->children()->first();
        $this->assertSame('btn', $el->attr('class'));
    }

    /**
     * @testWith [null, "button"]
     *           ["div", "div"]
     */
    public function testAsProp(?string $as, string $expectedNodeName): void
    {
        $rendered = $this->renderTwigComponent(
            name: 'Button',
            data: null !== $as ? ['as' => $as] : [],
        );

        $el = $rendered->crawler()->filter('body > *:first-child');
        $this->assertSame($expectedNodeName, $el->nodeName());
    }

    /**
     * @testWith [{"content": "<b>foo</b>"}, "<b>foo</b>"]
     *           [{"data": {"content": "foo"}}, "foo"]
     */
    public function testCanRenderContent(array $data, string $expectedContent): void
    {
        $rendered = $this->renderTwigComponent(
            name: 'Button',
            data: $data['data'] ?? [],
            content: $data['content'] ?? null,
        );

        $el = $rendered->crawler()->filter('body > *:first-child');
        $this->assertStringContainsString($expectedContent, $el->html());
    }

    public function testCanRenderAttributes(): void
    {
        $rendered = $this->renderTwigComponent(
            name: 'Button',
            data: ['foo' => 'bar'],
        );

        $el = $rendered->crawler()->filter('body > *:first-child');
        $this->assertSame('bar', $el->attr('foo'));
    }

    /**
     * @testWith [null, "btn"]
     *           ["", "btn"]
     *           ["neutral", "btn btn-neutral"]
     *           ["primary", "btn btn-primary"]
     *           ["secondary", "btn btn-secondary"]
     *           ["accent", "btn btn-accent"]
     *           ["info", "btn btn-info"]
     *           ["success", "btn btn-success"]
     *           ["warning", "btn btn-warning"]
     *           ["error", "btn btn-error"]
     *           ["ghost", "btn btn-ghost"]
     *           ["link", "btn btn-link"]
     *           ["grass", "btn grass"]
     */
    public function testThemeProp(?string $value, string $expectedClass): void
    {
        $rendered = $this->renderTwigComponent(
            name: 'Button',
            data: ['theme' => $value],
        );

        $el = $rendered->crawler()->filter('body > *:first-child');
        $this->assertSame($expectedClass, $el->attr('class'));
    }

    /**
     * @testWith [null, "btn"]
     *           ["", "btn"]
     *           ["lg", "btn btn-lg"]
     *           ["md", "btn btn-md"]
     *           ["sm", "btn btn-sm"]
     *           ["xs", "btn btn-xs"]
     */
    public function testSizeProp(?string $value, string $expectedCass): void
    {
        $rendered = $this->renderTwigComponent(
            name: 'Button',
            data: ['size' => $value],
        );

        $el = $rendered->crawler()->filter('body > *:first-child');
        $this->assertSame($expectedCass, $el->attr('class'));
    }

    /**
     * @testWith [null, "btn"]
     *           ["", "btn"]
     *           ["circle", "btn btn-circle"]
     *           ["square", "btn btn-square"]
     */
    public function testShapeProp(?string $value, string $expectedCass): void
    {
        $rendered = $this->renderTwigComponent(
            name: 'Button',
            data: ['shape' => $value],
        );

        $el = $rendered->crawler()->filter('body > *:first-child');
        $this->assertSame($expectedCass, $el->attr('class'));
    }

    /**
     * @testWith [null, "btn"]
     *           [false, "btn"]
     *           [true, "btn btn-outline"]
     */
    public function testOutlineProp(?bool $value, string $expectedCass): void
    {
        $rendered = $this->renderTwigComponent(
            name: 'Button',
            data: ['outline' => $value],
        );

        $el = $rendered->crawler()->filter('body > *:first-child');
        $this->assertSame($expectedCass, $el->attr('class'));
    }

    /**
     * @testWith [null, "btn"]
     *           [false, "btn"]
     *           [true, "btn btn-active"]
     */
    public function testActiveProp(?bool $value, string $expectedCass): void
    {
        $rendered = $this->renderTwigComponent(
            name: 'Button',
            data: ['active' => $value],
        );

        $el = $rendered->crawler()->filter('body > *:first-child');
        $this->assertSame($expectedCass, $el->attr('class'));
    }

    /**
     * @testWith [null, "btn"]
     *           [false, "btn"]
     *           [true, "btn btn-wide"]
     */
    public function testWideProp(?bool $value, string $expectedCass): void
    {
        $rendered = $this->renderTwigComponent(
            name: 'Button',
            data: ['wide' => $value],
        );

        $el = $rendered->crawler()->filter('body > *:first-child');
        $this->assertSame($expectedCass, $el->attr('class'));
    }

    /**
     * @testWith [null, "btn"]
     *           [false, "btn"]
     *           [true, "btn btn-block"]
     */
    public function testBlockProp(?bool $value, string $expectedCass): void
    {
        $rendered = $this->renderTwigComponent(
            name: 'Button',
            data: ['block' => $value],
        );

        $el = $rendered->crawler()->filter('body > *:first-child');
        $this->assertSame($expectedCass, $el->attr('class'));
    }

    /**
     * @testWith [null, "btn"]
     *           [false, "btn"]
     *           [true, "btn no-animation"]
     */
    public function testNoAnimationProp(?bool $value, string $expectedCass): void
    {
        $rendered = $this->renderTwigComponent(
            name: 'Button',
            data: ['noAnimation' => $value],
        );

        $el = $rendered->crawler()->filter('body > *:first-child');
        $this->assertSame($expectedCass, $el->attr('class'));
    }
}
