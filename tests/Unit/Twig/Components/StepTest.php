<?php

namespace Gremo\DaisyUITwigComponents\Tests\Unit\Twig\Components;

use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\UX\TwigComponent\Test\InteractsWithTwigComponents;

class StepTest extends KernelTestCase
{
    use InteractsWithTwigComponents;

    public function testRenderWithoutData(): void
    {
        $rendered = $this->renderTwigComponent(
            name: 'Step',
            data: [],
        );

        $body = $rendered->crawler()->children('body');

        $this->assertCount(1, $body->children());

        $el = $body->children()->first();

        $this->assertSame('li', $el->nodeName());
        $this->assertSame('step', $el->attr('class'));
        $this->assertEmpty($el->innerText());
    }

    public function testRenderWithData(): void
    {
        $rendered = $this->renderTwigComponent(
            name: 'Step',
            data: [
                'id' => 'my-step',
                'class' => 'step-custom',
                'data-controller' => 'step',
            ],
        );

        $el = $rendered->crawler()->filter('body > *:first-child');

        $this->assertSame('my-step', $el->attr('id'));
        $this->assertSame('step step-custom', $el->attr('class'));
        $this->assertSame('step', $el->attr('data-controller'));
    }

    public function testAsProp(): void
    {
        $rendered = $this->renderTwigComponent(
            name: 'Step',
            data: ['as' => 'a'],
        );

        $el = $rendered->crawler()->filter('body > *:first-child');

        $this->assertSame('a', $el->nodeName());
    }

    /**
     * @testWith ["accent", "step-accent"]
     *           ["error", "step-error"]
     *           ["info", "step-info"]
     *           ["neutral", "step-neutral"]
     *           ["primary", "step-primary"]
     *           ["secondary", "step-secondary"]
     *           ["success", "step-success"]
     *           ["warning", "step-warning"]
     */
    public function testColorProp(string $value, string $expectedCssClass): void
    {
        $rendered = $this->renderTwigComponent(
            name: 'Step',
            data: ['color' => $value],
        );

        $this->assertSame("step $expectedCssClass", $rendered->crawler()->filter('body > *:first-child')->attr('class'));
    }

    public function testInvalidColorPropThrows(): void
    {
        $this->expectException(\Twig\Error\RuntimeError::class);
        $this->expectExceptionMessageMatches('/option "color" with value "foo" is invalid/i');

        $this->renderTwigComponent(
            name: 'Step',
            data: ['color' => 'foo'],
        );
    }

    public function testIconPropr(): void
    {
        $rendered = $this->renderTwigComponent(
            name: 'Step',
            data: ['icon' => 'foo'],
        );

        $el = $rendered->crawler()->filter('body > *:first-child');

        $this->assertSame('foo', $el->attr('data-content'));
    }

    /**
     * @testWith ["foo", null, "foo"]
     *           [null, "<b>bar</b>", "<b>bar</b>"]
     *           ["foo", "<b>bar</b>", "<b>bar</b>"]
     */
    public function testContentPropOrSlot(?string $propContent, ?string $slotContent, string $expectedContent): void
    {
        $rendered = $this->renderTwigComponent(
            name: 'Step',
            data: null !== $propContent ? ['content' => $propContent] : [],
            content: $slotContent
        );

        $el = $rendered->crawler()->filter('body > *:first-child');

        $this->assertSame($expectedContent, trim($el->html()));
    }
}
