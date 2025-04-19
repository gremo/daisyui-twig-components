<?php

namespace Gremo\DaisyUITwigComponents\Tests\Unit\Twig\Components;

use Gremo\DaisyUITwigComponents\Twig\Components\Progress;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\UX\TwigComponent\Test\InteractsWithTwigComponents;

class ProgressTest extends KernelTestCase
{
    use InteractsWithTwigComponents;

    public function testMount(): void
    {
        $component = $this->mountTwigComponent(
            name: 'Progress',
            data: [],
        );

        $this->assertInstanceOf(Progress::class, $component);
        $this->assertNull($component->color);
    }

    public function testRenderWithoutData(): void
    {
        $rendered = $this->renderTwigComponent(
            name: 'Progress',
            data: [],
        );

        $body = $rendered->crawler()->children('body');
        $this->assertCount(1, $body->children());

        $el = $body->children()->first();
        $this->assertSame('progress', $el->nodeName());
        $this->assertSame('progress', $el->attr('class'));
        $this->assertEmpty($el->innerText());
    }

    public function testRenderWithData(): void
    {
        $rendered = $this->renderTwigComponent(
            name: 'Progress',
            data: [
                'id' => 'my-progress',
                'class' => 'progress-custom',
                'value' => '75',
                'max' => '100',
            ],
        );

        $el = $rendered->crawler()->filter('body > *:first-child');

        $this->assertSame('my-progress', $el->attr('id'));
        $this->assertSame('progress progress-custom', $el->attr('class'));
        $this->assertSame('75', $el->attr('value'));
        $this->assertSame('100', $el->attr('max'));
    }

    /**
     * @testWith ["accent", "progress-accent"]
     *           ["error", "progress-error"]
     *           ["info", "progress-info"]
     *           ["neutral", "progress-neutral"]
     *           ["primary", "progress-primary"]
     *           ["secondary", "progress-secondary"]
     *           ["success", "progress-success"]
     *           ["warning", "progress-warning"]
     */
    public function testColorProp(string $value, string $expectedCssClass): void
    {
        $rendered = $this->renderTwigComponent(
            name: 'Progress',
            data: ['color' => $value],
        );

        $this->assertSame("progress $expectedCssClass", $rendered->crawler()->filter('body > *:first-child')->attr('class'));
    }

    public function testInvalidColorPropThrows(): void
    {
        $this->expectException(\Twig\Error\RuntimeError::class);
        $this->expectExceptionMessageMatches('/option "color" with value "foo" is invalid/i');

        $this->renderTwigComponent(
            name: 'Progress',
            data: ['color' => 'foo'],
        );
    }
}
