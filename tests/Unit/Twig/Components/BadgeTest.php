<?php

namespace Gremo\DaisyUITwigComponents\Tests\Unit\Twig\Components;

use Gremo\DaisyUITwigComponents\Twig\Components\Badge;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\UX\TwigComponent\Test\InteractsWithTwigComponents;

class BadgeTest extends KernelTestCase
{
    use InteractsWithTwigComponents;

    public function testMount(): void
    {
        $component = $this->mountTwigComponent(
            name: 'Badge',
            data: [],
        );

        $this->assertInstanceOf(Badge::class, $component);
        $this->assertSame('span', $component->as);
        $this->assertNull($component->content);
        $this->assertNull($component->color);
        $this->assertNull($component->size);
        $this->assertNull($component->variant);
    }

    public function testRenderWithoutData(): void
    {
        $rendered = $this->renderTwigComponent(
            name: 'Badge',
            data: [],
        );

        $body = $rendered->crawler()->children('body');
        $this->assertCount(1, $body->children());

        $el = $body->children()->first();
        $this->assertSame('span', $el->nodeName());
        $this->assertSame('badge', $el->attr('class'));
        $this->assertEmpty($el->innerText());
    }

    public function testRenderWithData(): void
    {
        $rendered = $this->renderTwigComponent(
            name: 'Badge',
            data: [
                'id' => 'foo',
                'class' => 'bar',
            ],
        );

        $el = $rendered->crawler()->filter('body > *:first-child');

        $this->assertSame('foo', $el->attr('id'));
        $this->assertSame('badge bar', $el->attr('class'));
    }

    /**
     * @testWith ["foo", null, "foo"]
     *           [null, "<b>bar</b>", "<b>bar</b>"]
     *           ["foo", "<b>bar</b>", "<b>bar</b>"]
     */
    public function testContentPropOrSlot(?string $propContent, ?string $slotContent, string $expectedContent): void
    {
        $rendered = $this->renderTwigComponent(
            name: 'Badge',
            data: null !== $propContent ? ['content' => $propContent] : [],
            content: $slotContent
        );

        $this->assertSame($expectedContent, trim($rendered->crawler()->filter('body > *:first-child')->html()));
    }

    /**
     * @testWith ["accent", "badge-accent"]
     *           ["error", "badge-error"]
     *           ["info", "badge-info"]
     *           ["neutral", "badge-neutral"]
     *           ["primary", "badge-primary"]
     *           ["secondary", "badge-secondary"]
     *           ["success", "badge-success"]
     *           ["warning", "badge-warning"]
     */
    public function testColorProp(string $value, string $expectedCssClass): void
    {
        $rendered = $this->renderTwigComponent(
            name: 'Badge',
            data: ['color' => $value],
        );

        $this->assertSame("badge $expectedCssClass", $rendered->crawler()->filter('body > *:first-child')->attr('class'));
    }

    public function testInvalidColorPropThrows(): void
    {
        $this->expectException(\Twig\Error\RuntimeError::class);
        $this->expectExceptionMessageMatches('/option "color" with value "foo" is invalid/i');

        $this->renderTwigComponent(
            name: 'Badge',
            data: ['color' => 'foo'],
        );
    }

    /**
     * @testWith ["dash", "badge-dash"]
     *           ["ghost", "badge-ghost"]
     *           ["outline", "badge-outline"]
     *           ["soft", "badge-soft"]
     */
    public function testVariantProp(string $value, string $expectedCssClass): void
    {
        $rendered = $this->renderTwigComponent(
            name: 'Badge',
            data: ['variant' => $value],
        );

        $this->assertSame("badge $expectedCssClass", $rendered->crawler()->filter('body > *:first-child')->attr('class'));
    }

    public function testInvalidVariantPropThrows(): void
    {
        $this->expectException(\Twig\Error\RuntimeError::class);
        $this->expectExceptionMessageMatches('/option "variant" with value "foo" is invalid/i');

        $this->renderTwigComponent(
            name: 'Badge',
            data: ['variant' => 'foo'],
        );
    }

    /**
     * @testWith ["lg", "badge-lg"]
     *           ["md", "badge-md"]
     *           ["sm", "badge-sm"]
     *           ["xl", "badge-xl"]
     *           ["xs", "badge-xs"]
     */
    public function testSizeProp(string $value, string $expectedCssClass): void
    {
        $rendered = $this->renderTwigComponent(
            name: 'Badge',
            data: ['size' => $value],
        );

        $this->assertSame("badge $expectedCssClass", $rendered->crawler()->filter('body > *:first-child')->attr('class'));
    }

    public function testInvalidSizePropThrows(): void
    {
        $this->expectException(\Twig\Error\RuntimeError::class);
        $this->expectExceptionMessageMatches('/option "size" with value "foo" is invalid/i');

        $this->renderTwigComponent(
            name: 'Badge',
            data: ['size' => 'foo'],
        );
    }
}
