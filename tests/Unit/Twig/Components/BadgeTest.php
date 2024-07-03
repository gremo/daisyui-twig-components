<?php

namespace Gremo\DaisyUITwigComponents\Tests\Unit\Twig\Components;

use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\UX\TwigComponent\Test\InteractsWithTwigComponents;

class BadgeTest extends KernelTestCase
{
    use InteractsWithTwigComponents;

    public function testRenderingWithDefaults(): void
    {
        $rendered = $this->renderTwigComponent(
            name: 'Badge',
            data: [],
        );

        $body = $rendered->crawler()->children('body');
        $this->assertCount(1, $body->children());

        $el = $body->children()->first();
        $this->assertSame('badge', $el->attr('class'));
    }

    /**
     * @testWith [null, "div"]
     *           ["span", "span"]
     */
    public function testAsProp(?string $value, string $expectedNodeName): void
    {
        $rendered = $this->renderTwigComponent(
            name: 'Badge',
            data: null !== $value ? ['as' => $value] : [],
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
            name: 'Badge',
            data: $data['data'] ?? [],
            content: $data['content'] ?? null,
        );

        $el = $rendered->crawler()->filter('body > *:first-child');
        $this->assertStringContainsString($expectedContent, $el->html());
    }

    public function testCanRenderAttributes(): void
    {
        $rendered = $this->renderTwigComponent(
            name: 'Badge',
            data: ['foo' => 'bar'],
        );

        $el = $rendered->crawler()->filter('body > *:first-child');
        $this->assertSame('bar', $el->attr('foo'));
    }

    /**
     * @testWith [null, "badge"]
     *           ["", "badge"]
     *           ["neutral", "badge badge-neutral"]
     *           ["primary", "badge badge-primary"]
     *           ["secondary", "badge badge-secondary"]
     *           ["accent", "badge badge-accent"]
     *           ["ghost", "badge badge-ghost"]
     *           ["info", "badge badge-info"]
     *           ["success", "badge badge-success"]
     *           ["warning", "badge badge-warning"]
     *           ["error", "badge badge-error"]
     */
    public function testThemeProp(?string $value, string $expectedCass): void
    {
        $rendered = $this->renderTwigComponent(
            name: 'Badge',
            data: ['theme' => $value],
        );

        $el = $rendered->crawler()->filter('body > *:first-child');
        $this->assertSame($expectedCass, $el->attr('class'));
    }

    /**
     * @testWith [null, "badge"]
     *           ["", "badge"]
     *           ["lg", "badge badge-lg"]
     *           ["md", "badge badge-md"]
     *           ["sm", "badge badge-sm"]
     *           ["xs", "badge badge-xs"]
     */
    public function testSizeProp(?string $value, string $expectedCass): void
    {
        $rendered = $this->renderTwigComponent(
            name: 'Badge',
            data: ['size' => $value],
        );

        $el = $rendered->crawler()->filter('body > *:first-child');
        $this->assertSame($expectedCass, $el->attr('class'));
    }

    /**
     * @testWith [null, "badge"]
     *           [false, "badge"]
     *           [true, "badge badge-outline"]
     */
    public function testOutlineProp(?bool $value, string $expectedCass): void
    {
        $rendered = $this->renderTwigComponent(
            name: 'Badge',
            data: ['outline' => $value],
        );

        $el = $rendered->crawler()->filter('body > *:first-child');
        $this->assertSame($expectedCass, $el->attr('class'));
    }
}
