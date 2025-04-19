<?php

namespace Gremo\DaisyUITwigComponents\Tests\Unit\Twig\Components;

use Gremo\DaisyUITwigComponents\Twig\Components\Collapse;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\UX\TwigComponent\Test\InteractsWithTwigComponents;

class CollapseTest extends KernelTestCase
{
    use InteractsWithTwigComponents;

    public function testMount(): void
    {
        $component = $this->mountTwigComponent(
            name: 'Collapse',
            data: [],
        );

        $this->assertInstanceOf(Collapse::class, $component);
        $this->assertSame('div', $component->as);
        $this->assertNull($component->icon);
        $this->assertFalse($component->open);
    }

    public function testRenderWithoutData(): void
    {
        $rendered = $this->renderTwigComponent(
            name: 'Collapse',
            data: [],
        );

        $body = $rendered->crawler()->children('body');

        $this->assertCount(1, $body->children());

        $el = $body->children()->first();
        $this->assertSame('div', $el->nodeName());
        $this->assertSame('collapse', $el->attr('class'));
        $this->assertSame('0', $el->attr('tabindex'));

        $this->assertCount(0, $el->children());
    }

    public function testRenderWithData(): void
    {
        $rendered = $this->renderTwigComponent(
            name: 'Collapse',
            data: [
                'id' => 'my-collapse',
                'class' => 'collapse-custom',
                'data-controller' => 'collapse',
            ],
        );

        $el = $rendered->crawler()->filter('body > *:first-child');
        $this->assertSame('my-collapse', $el->attr('id'));
        $this->assertSame('collapse collapse-custom', $el->attr('class'));
        $this->assertSame('collapse', $el->attr('data-controller'));
    }

    public function testAsProp(): void
    {
        $rendered = $this->renderTwigComponent(
            name: 'Collapse',
            data: ['as' => 'section'],
        );

        $el = $rendered->crawler()->filter('body > *:first-child');

        $this->assertSame('section', $el->nodeName());
    }

    public function testContentSlot(): void
    {
        $rendered = $this->renderTwigComponent(
            name: 'Collapse',
            content: '<b>foo</b>',
        );

        $el = $rendered->crawler()->filter('body > *:first-child');

        $this->assertSame('<b>foo</b>', trim($el->html()));
    }

    /**
     * @testWith ["arrow", "collapse-arrow"]
     *           ["plus", "collapse-plus"]
     */
    public function testIconProp(string $value, string $expectedCssClass): void
    {
        $rendered = $this->renderTwigComponent(
            name: 'Collapse',
            data: ['icon' => $value],
        );

        $this->assertSame("collapse $expectedCssClass", $rendered->crawler()->filter('body > *:first-child')->attr('class'));
    }

    public function testInvalidIconPropThrows(): void
    {
        $this->expectException(\Twig\Error\RuntimeError::class);
        $this->expectExceptionMessageMatches('/option "icon" with value "foo" is invalid/i');

        $this->renderTwigComponent(
            name: 'Collapse',
            data: ['icon' => 'foo'],
        );
    }

    /**
     * @testWith [false, "collapse"]
     *           [true, "collapse collapse-open"]
     */
    public function testOpenProp(?bool $value, string $expectedCssClass): void
    {
        $rendered = $this->renderTwigComponent(
            name: 'Collapse',
            data: ['open' => $value],
        );

        $this->assertSame($expectedCssClass, $rendered->crawler()->filter('body > *:first-child')->attr('class'));
    }

    public function testTriggerClickProp(): void
    {
        $rendered = $this->renderTwigComponent(
            name: 'Collapse',
            data: [
                'trigger' => 'click',
            ],
        );

        $el = $rendered->crawler()->filter('body > *:first-child');

        $this->assertNull($el->attr('tabindex'));

        $this->assertCount(1, $el->children());

        $input = $el->children()->first();
        $this->assertSame('input', $input->nodeName());
        $this->assertSame('checkbox', $input->attr('type'));
    }
}
