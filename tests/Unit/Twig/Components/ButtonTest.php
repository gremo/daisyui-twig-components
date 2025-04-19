<?php

namespace Gremo\DaisyUITwigComponents\Tests\Unit\Twig\Components;

use Gremo\DaisyUITwigComponents\Twig\Components\Button;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\UX\TwigComponent\Test\InteractsWithTwigComponents;

class ButtonTest extends KernelTestCase
{
    use InteractsWithTwigComponents;

    public function testMount(): void
    {
        $component = $this->mountTwigComponent(
            name: 'Button',
            data: [],
        );

        $this->assertInstanceOf(Button::class, $component);
        $this->assertSame('button', $component->as);
        $this->assertNull($component->content);
        $this->assertFalse($component->active);
        $this->assertFalse($component->block);
        $this->assertFalse($component->wide);
        $this->assertNull($component->color);
        $this->assertNull($component->shape);
        $this->assertNull($component->size);
        $this->assertNull($component->variant);
    }

    public function testRenderWithoutData(): void
    {
        $rendered = $this->renderTwigComponent(
            name: 'Button',
            data: [],
        );

        $body = $rendered->crawler()->children('body');
        $this->assertCount(1, $body->children());

        $el = $body->children()->first();
        $this->assertSame('button', $el->nodeName());
        $this->assertSame('btn', $el->attr('class'));
        $this->assertNull($el->attr('role'));
        $this->assertEmpty($el->innerText());
    }

    public function testRenderWithData(): void
    {
        $rendered = $this->renderTwigComponent(
            name: 'Button',
            data: [
                'id' => 'my-button',
                'class' => 'btn-custom',
                'type' => 'button',
            ],
        );

        $el = $rendered->crawler()->filter('body > *:first-child');

        $this->assertSame('my-button', $el->attr('id'));
        $this->assertSame('btn btn-custom', $el->attr('class'));
        $this->assertSame('button', $el->attr('type'));
    }

    /**
     * @testWith [{"as": "button"}, {"role": null}]
     *           [{"as": "a"}, {"role": "button"}]
     *           [{"as": "a", "href": "#"}, {"role": null}]
     */
    public function testAsProp(array $data, array $attributes): void
    {
        $rendered = $this->renderTwigComponent(
            name: 'Button',
            data: $data,
        );

        $el = $rendered->crawler()->filter('body > *:first-child');

        $this->assertSame($data['as'], $el->nodeName());
        foreach ($attributes as $name => $value) {
            $this->assertSame($value, $el->attr($name));
        }
    }

    /**
     * @testWith ["foo", null, "foo"]
     *           [null, "<b>bar</b>", "<b>bar</b>"]
     *           ["foo", "<b>bar</b>", "<b>bar</b>"]
     */
    public function testContentPropOrSlot(?string $propContent, ?string $slotContent, string $expectedContent): void
    {
        $rendered = $this->renderTwigComponent(
            name: 'Button',
            data: null !== $propContent ? ['content' => $propContent] : [],
            content: $slotContent
        );

        $this->assertSame($expectedContent, trim($rendered->crawler()->filter('body > *:first-child')->html()));
    }

    /**
     * @testWith ["circle", "btn-circle"]
     *           ["square", "btn-square"]
     */
    public function testShapeProp(string $value, string $expectedCssClass): void
    {
        $rendered = $this->renderTwigComponent(
            name: 'Button',
            data: ['shape' => $value],
        );

        $this->assertSame("btn $expectedCssClass", $rendered->crawler()->filter('body > *:first-child')->attr('class'));
    }

    public function testInvalidShapePropThrows(): void
    {
        $this->expectException(\Twig\Error\RuntimeError::class);
        $this->expectExceptionMessageMatches('/option "shape" with value "foo" is invalid/i');

        $this->renderTwigComponent(
            name: 'Button',
            data: ['shape' => 'foo'],
        );
    }

    /**
     * @testWith ["lg", "btn-lg"]
     *           ["md", "btn-md"]
     *           ["sm", "btn-sm"]
     *           ["xl", "btn-xl"]
     *           ["xs", "btn-xs"]
     */
    public function testSizeProp(string $value, string $expectedCssClass): void
    {
        $rendered = $this->renderTwigComponent(
            name: 'Button',
            data: ['size' => $value],
        );

        $this->assertSame("btn $expectedCssClass", $rendered->crawler()->filter('body > *:first-child')->attr('class'));
    }

    public function testInvalidSizePropThrows(): void
    {
        $this->expectException(\Twig\Error\RuntimeError::class);
        $this->expectExceptionMessageMatches('/option "size" with value "foo" is invalid/i');

        $this->renderTwigComponent(
            name: 'Button',
            data: ['size' => 'foo'],
        );
    }

    /**
     * @testWith ["dash", "btn-dash"]
     *           ["ghost", "btn-ghost"]
     *           ["link", "btn-link"]
     *           ["outline", "btn-outline"]
     *           ["soft", "btn-soft"]
     */
    public function testVariantProp(string $value, string $expectedCssClass): void
    {
        $rendered = $this->renderTwigComponent(
            name: 'Button',
            data: ['variant' => $value],
        );

        $this->assertSame("btn $expectedCssClass", $rendered->crawler()->filter('body > *:first-child')->attr('class'));
    }

    public function testInvalidVariantPropThrows(): void
    {
        $this->expectException(\Twig\Error\RuntimeError::class);
        $this->expectExceptionMessageMatches('/option "variant" with value "foo" is invalid/i');

        $this->renderTwigComponent(
            name: 'Button',
            data: ['variant' => 'foo'],
        );
    }

    /**
     * @testWith ["accent", "btn-accent"]
     *           ["error", "btn-error"]
     *           ["info", "btn-info"]
     *           ["neutral", "btn-neutral"]
     *           ["primary", "btn-primary"]
     *           ["secondary", "btn-secondary"]
     *           ["success", "btn-success"]
     *           ["warning", "btn-warning"]
     */
    public function testColorProp(string $value, string $expectedCssClass): void
    {
        $rendered = $this->renderTwigComponent(
            name: 'Button',
            data: ['color' => $value],
        );

        $this->assertSame("btn $expectedCssClass", $rendered->crawler()->filter('body > *:first-child')->attr('class'));
    }

    public function testInvalidThemePropThrows(): void
    {
        $this->expectException(\Twig\Error\RuntimeError::class);
        $this->expectExceptionMessageMatches('/option "color" with value "foo" is invalid/i');

        $this->renderTwigComponent(
            name: 'Button',
            data: ['color' => 'foo'],
        );
    }

    /**
     * @testWith [false, "btn"]
     *           [true, "btn btn-active"]
     */
    public function testActiveProp(?bool $value, string $expectedCssClass): void
    {
        $rendered = $this->renderTwigComponent(
            name: 'Button',
            data: ['active' => $value],
        );

        $this->assertSame($expectedCssClass, $rendered->crawler()->filter('body > *:first-child')->attr('class'));
    }

    /**
     * @testWith [false, "btn"]
     *           [true, "btn btn-block"]
     */
    public function testBlockProp(?bool $value, string $expectedCssClass): void
    {
        $rendered = $this->renderTwigComponent(
            name: 'Button',
            data: ['block' => $value],
        );

        $this->assertSame($expectedCssClass, $rendered->crawler()->filter('body > *:first-child')->attr('class'));
    }

    /**
     * @testWith [false, "btn"]
     *           [true, "btn btn-wide"]
     */
    public function testWideProp(?bool $value, string $expectedCssClass): void
    {
        $rendered = $this->renderTwigComponent(
            name: 'Button',
            data: ['wide' => $value],
        );

        $this->assertSame($expectedCssClass, $rendered->crawler()->filter('body > *:first-child')->attr('class'));
    }
}
