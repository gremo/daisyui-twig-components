<?php

namespace Gremo\DaisyUITwigComponents\Tests\Unit\Twig\Components;

use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\UX\TwigComponent\Test\InteractsWithTwigComponents;

class AlertTest extends KernelTestCase
{
    use InteractsWithTwigComponents;

    public function testRenderingWithDefaults(): void
    {
        $rendered = $this->renderTwigComponent(
            name: 'Alert',
            data: [],
        );

        $body = $rendered->crawler()->children('body');
        $this->assertCount(1, $body->children());

        $el = $body->children()->first();
        $this->assertSame('div', $el->nodeName());
        $this->assertSame('alert', $el->attr('class'));
    }

    /**
     * @testWith [null, "div"]
     *           ["span", "span"]
     */
    public function testAsProp(?string $value, string $expectedNodeName): void
    {
        $rendered = $this->renderTwigComponent(
            name: 'Alert',
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
            name: 'Alert',
            data: $data['data'] ?? [],
            content: $data['content'] ?? null,
        );

        $el = $rendered->crawler()->filter('body > *:first-child');
        $this->assertStringContainsString($expectedContent, $el->html());
    }

    public function testCanRenderAttributes(): void
    {
        $rendered = $this->renderTwigComponent(
            name: 'Alert',
            data: ['foo' => 'bar'],
        );

        $el = $rendered->crawler()->filter('body > *:first-child');
        $this->assertSame('bar', $el->attr('foo'));
    }

    /**
     * @testWith [null, "alert"]
     *           ["", "alert"]
     *           ["success", "alert alert-success"]
     *           ["info", "alert alert-info"]
     *           ["warning", "alert alert-warning"]
     *           ["error", "alert alert-error"]
     */
    public function testThemeProp(?string $value, string $expectedClass): void
    {
        $rendered = $this->renderTwigComponent(
            name: 'Alert',
            data: ['theme' => $value],
        );

        $el = $rendered->crawler()->filter('body > *:first-child');
        $this->assertSame($expectedClass, $el->attr('class'));
    }
}
