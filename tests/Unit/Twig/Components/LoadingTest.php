<?php

namespace Gremo\DaisyUITwigComponents\Tests\Unit\Twig\Components;

use Gremo\DaisyUITwigComponents\Twig\Components\Loading;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\UX\TwigComponent\Test\InteractsWithTwigComponents;

class LoadingTest extends KernelTestCase
{
    use InteractsWithTwigComponents;

    public function testMount(): void
    {
        $component = $this->mountTwigComponent(
            name: 'Loading',
            data: [],
        );

        $this->assertInstanceOf(Loading::class, $component);
        $this->assertSame('span', $component->as);
        $this->assertSame('span', $component->as);
        $this->assertNull($component->size);
        $this->assertNull($component->variant);
    }

    public function testRenderWithoutData(): void
    {
        $rendered = $this->renderTwigComponent(
            name: 'Loading',
            data: [],
        );

        $body = $rendered->crawler()->children('body');
        $this->assertCount(1, $body->children());

        $el = $body->children()->first();
        $this->assertSame('span', $el->nodeName());
        $this->assertSame('loading', $el->attr('class'));
        $this->assertEmpty($el->innerText());
    }

    public function testRenderWithData(): void
    {
        $rendered = $this->renderTwigComponent(
            name: 'Loading',
            data: [
                'id' => 'my-loading',
                'class' => 'loading-custom',
                'data-controller' => 'controller',
            ],
        );

        $el = $rendered->crawler()->filter('body > *:first-child');

        $this->assertSame('my-loading', $el->attr('id'));
        $this->assertSame('loading loading-custom', $el->attr('class'));
        $this->assertSame('controller', $el->attr('data-controller'));
    }

    /**
     * @testWith ["lg", "loading-lg"]
     *           ["md", "loading-md"]
     *           ["sm", "loading-sm"]
     *           ["xl", "loading-xl"]
     *           ["xs", "loading-xs"]
     */
    public function testSizeProp(string $value, string $expectedCssClass): void
    {
        $rendered = $this->renderTwigComponent(
            name: 'Loading',
            data: ['size' => $value],
        );

        $this->assertSame("loading $expectedCssClass", $rendered->crawler()->filter('body > *:first-child')->attr('class'));
    }

    public function testInvalidSizePropThrows(): void
    {
        $this->expectException(\Twig\Error\RuntimeError::class);
        $this->expectExceptionMessageMatches('/option "size" with value "foo" is invalid/i');

        $this->renderTwigComponent(
            name: 'Loading',
            data: ['size' => 'foo'],
        );
    }

    /**
     * @testWith ["ball", "loading-ball"]
     *           ["bars", "loading-bars"]
     *           ["dots", "loading-dots"]
     *           ["infinity", "loading-infinity"]
     *           ["ring", "loading-ring"]
     *           ["spinner", "loading-spinner"]
     */
    public function testVariantProp(string $value, string $expectedCssClass): void
    {
        $rendered = $this->renderTwigComponent(
            name: 'Loading',
            data: ['variant' => $value],
        );

        $this->assertSame("loading $expectedCssClass", $rendered->crawler()->filter('body > *:first-child')->attr('class'));
    }

    public function testInvalidVariantPropThrows(): void
    {
        $this->expectException(\Twig\Error\RuntimeError::class);
        $this->expectExceptionMessageMatches('/option "variant" with value "foo" is invalid/i');

        $this->renderTwigComponent(
            name: 'Loading',
            data: ['variant' => 'foo'],
        );
    }
}
