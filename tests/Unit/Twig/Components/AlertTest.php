<?php

namespace Gremo\DaisyUITwigComponents\Tests\Unit\Twig\Components;

use Gremo\DaisyUITwigComponents\Twig\Components\Alert;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\UX\TwigComponent\Test\InteractsWithTwigComponents;

class AlertTest extends KernelTestCase
{
    use InteractsWithTwigComponents;

    public function testMount(): void
    {
        $component = $this->mountTwigComponent(
            name: 'Alert',
            data: [],
        );

        $this->assertInstanceOf(Alert::class, $component);
        $this->assertSame('div', $component->as);
        $this->assertNull($component->color);
        $this->assertNull($component->content);
        $this->assertNull($component->direction);
        $this->assertNull($component->variant);
    }

    public function testRenderWithoutData(): void
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
        $this->assertSame('alert', $el->attr('role'));
        $this->assertEmpty($el->innerText());
    }

    public function testRenderWithData(): void
    {
        $rendered = $this->renderTwigComponent(
            name: 'Alert',
            data: [
                'id' => 'foo',
                'class' => 'bar',
                'role' => 'baz',
            ],
        );

        $el = $rendered->crawler()->filter('body > *:first-child');

        $this->assertSame('foo', $el->attr('id'));
        $this->assertSame('alert bar', $el->attr('class'));
        $this->assertSame('baz', $el->attr('role'));
    }

    /**
     * @testWith ["foo", null, "<span>foo</span>"]
     *           [null, "<b>bar</b>", "<b>bar</b>"]
     *           ["foo", "<b>bar</b>", "<b>bar</b>"]
     */
    public function testContentPropOrSlot(?string $propContent, ?string $slotContent, string $expectedContent): void
    {
        $rendered = $this->renderTwigComponent(
            name: 'Alert',
            data: null !== $propContent ? ['content' => $propContent] : [],
            content: $slotContent
        );

        $this->assertSame($expectedContent, trim($rendered->crawler()->filter('body > *:first-child')->html()));
    }

    /**
     * @testWith ["error", "alert-error"]
     *           ["info", "alert-info"]
     *           ["success", "alert-success"]
     *           ["warning", "alert-warning"]
     */
    public function testColorProp(string $value, string $expectedCssClass): void
    {
        $rendered = $this->renderTwigComponent(
            name: 'Alert',
            data: ['color' => $value],
        );

        $this->assertSame("alert $expectedCssClass", $rendered->crawler()->filter('body > *:first-child')->attr('class'));
    }

    public function testInvalidColorPropThrows(): void
    {
        $this->expectException(\Twig\Error\RuntimeError::class);
        $this->expectExceptionMessageMatches('/option "color" with value "foo" is invalid/i');

        $this->renderTwigComponent(
            name: 'Alert',
            data: ['color' => 'foo'],
        );
    }

    /**
     * @testWith ["outline", "alert-outline"]
     *           ["dash", "alert-dash"]
     *           ["soft", "alert-soft"]
     */
    public function testVariantProp(string $value, string $expectedCssClass): void
    {
        $rendered = $this->renderTwigComponent(
            name: 'Alert',
            data: ['variant' => $value],
        );

        $this->assertSame("alert $expectedCssClass", $rendered->crawler()->filter('body > *:first-child')->attr('class'));
    }

    public function testInvalidVariantPropThrows(): void
    {
        $this->expectException(\Twig\Error\RuntimeError::class);
        $this->expectExceptionMessageMatches('/option "variant" with value "foo" is invalid/i');

        $this->renderTwigComponent(
            name: 'Alert',
            data: ['variant' => 'foo'],
        );
    }

    /**
     * @testWith ["horizontal", "alert-horizontal"]
     *           ["vertical", "alert-vertical"]
     */
    public function testDirectionProp(string $value, string $expectedCssClass): void
    {
        $rendered = $this->renderTwigComponent(
            name: 'Alert',
            data: ['direction' => $value],
        );

        $this->assertSame("alert $expectedCssClass", $rendered->crawler()->filter('body > *:first-child')->attr('class'));
    }

    public function testInvalidDirectionPropThrows(): void
    {
        $this->expectException(\Twig\Error\RuntimeError::class);
        $this->expectExceptionMessageMatches('/option "direction" with value "foo" is invalid/i');

        $this->renderTwigComponent(
            name: 'Alert',
            data: ['direction' => 'foo'],
        );
    }
}
