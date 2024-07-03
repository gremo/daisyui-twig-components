<?php

namespace Gremo\DaisyUITwigComponents\Tests\Unit\Twig\Components;

use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\UX\TwigComponent\Test\InteractsWithTwigComponents;

class LoadingTest extends KernelTestCase
{
    use InteractsWithTwigComponents;

    public function testRenderingWithDefaults(): void
    {
        $rendered = $this->renderTwigComponent(
            name: 'Loading',
            data: [],
        );

        $body = $rendered->crawler()->children('body');
        $this->assertCount(1, $body->children());

        $el = $body->children()->first();
        $this->assertSame('loading', $el->attr('class'));
    }

    /**
     * @testWith [null, "span"]
     *           ["div", "div"]
     */
    public function testAsProp(?string $value, string $expectedNodeName): void
    {
        $rendered = $this->renderTwigComponent(
            name: 'Loading',
            data: null !== $value ? ['as' => $value] : [],
        );

        $el = $rendered->crawler()->filter('body > *:first-child');
        $this->assertSame($expectedNodeName, $el->nodeName());
    }

    /**
     * @testWith ["foo", "foo"]
     */
    public function testCannotRenderContent(string $value, string $expectedContent): void
    {
        $rendered = $this->renderTwigComponent(
            name: 'Loading',
            content: $value,
        );

        $el = $rendered->crawler()->filter('body > *:first-child');
        $this->assertStringNotContainsString($expectedContent, $el->html());
    }

    public function testCanRenderAttributes(): void
    {
        $rendered = $this->renderTwigComponent(
            name: 'Loading',
            data: ['foo' => 'bar'],
        );

        $el = $rendered->crawler()->filter('body > *:first-child');
        $this->assertSame('bar', $el->attr('foo'));
    }

    /**
     * @testWith [null, "loading"]
     *           ["", "loading"]
     *           ["spinner", "loading loading-spinner"]
     *           ["dots", "loading loading-dots"]
     *           ["ring", "loading loading-ring"]
     *           ["ball", "loading loading-ball"]
     *           ["bars", "loading loading-bars"]
     *           ["infinity", "loading loading-infinity"]
     */
    public function testShapeProp(?string $value, string $expectedCass): void
    {
        $rendered = $this->renderTwigComponent(
            name: 'Loading',
            data: ['shape' => $value],
        );

        $el = $rendered->crawler()->filter('body > *:first-child');
        $this->assertSame($expectedCass, $el->attr('class'));
    }
}
