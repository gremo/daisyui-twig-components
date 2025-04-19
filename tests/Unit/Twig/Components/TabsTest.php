<?php

namespace Gremo\DaisyUITwigComponents\Tests\Unit\Twig\Components;

use Gremo\DaisyUITwigComponents\Twig\Components\Tabs;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\UX\TwigComponent\Test\InteractsWithTwigComponents;

class TabsTest extends KernelTestCase
{
    use InteractsWithTwigComponents;

    public function testMount(): void
    {
        $component = $this->mountTwigComponent(
            name: 'Tabs',
            data: [],
        );

        $this->assertInstanceOf(Tabs::class, $component);
        $this->assertSame('div', $component->as);
        $this->assertStringMatchesFormat('tabs-%d', $component->id);
        $this->assertNull($component->placement);
        $this->assertNull($component->size);
        $this->assertNull($component->style);

        $inputAttrs = $component->getInputAttributes();
        $this->assertTrue($inputAttrs->has('name'));
        $this->assertStringMatchesFormat('tabs-%d-input', $inputAttrs->all()['name']);
    }

    public function testRenderWithoutData(): void
    {
        $rendered = $this->renderTwigComponent(
            name: 'Tabs',
            data: [],
        );

        $body = $rendered->crawler()->children('body');

        $this->assertCount(1, $body->children());

        $el = $body->children()->first();
        $this->assertSame('div', $el->nodeName());
        $this->assertStringMatchesFormat('tabs-%d', $el->attr('id'));
        $this->assertSame('tabs', $el->attr('class'));
        $this->assertSame('tablist', $el->attr('role'));
        $this->assertEmpty($el->innerText());
    }

    public function testRenderWithData(): void
    {
        $rendered = $this->renderTwigComponent(
            name: 'Tabs',
            data: [
                'id' => 'my-tabs',
                'class' => 'tabs-custom',
                'type' => 'button',
                'role' => 'custom',
            ],
        );

        $el = $rendered->crawler()->filter('body > *:first-child');

        $this->assertSame('my-tabs', $el->attr('id'));
        $this->assertSame('tabs tabs-custom', $el->attr('class'));
        $this->assertSame('button', $el->attr('type'));
        $this->assertSame('tablist', $el->attr('role'));
    }

    public function testAsProp(): void
    {
        $rendered = $this->renderTwigComponent(
            name: 'Tabs',
            data: ['as' => 'nav'],
        );

        $el = $rendered->crawler()->filter('body > *:first-child');

        $this->assertSame('nav', $el->nodeName());
    }

    public function testContentSlot(): void
    {
        $rendered = $this->renderTwigComponent(
            name: 'Tabs',
            content: '<b>foo</b>',
        );

        $el = $rendered->crawler()->filter('body > *:first-child');

        $this->assertSame('<b>foo</b>', trim($el->children()->last()->outerHtml()));
    }

    /**
     * @testWith ["top", "tabs-top"]
     *           ["bottom", "tabs-bottom"]
     */
    public function testPlacementProp(string $value, string $expectedCssClass): void
    {
        $rendered = $this->renderTwigComponent(
            name: 'Tabs',
            data: ['placement' => $value],
        );

        $this->assertSame("tabs $expectedCssClass", $rendered->crawler()->filter('body > *:first-child')->attr('class'));
    }

    public function testInvalidPlacementPropThrows(): void
    {
        $this->expectException(\Twig\Error\RuntimeError::class);
        $this->expectExceptionMessageMatches('/option "placement" with value "foo" is invalid/i');

        $this->renderTwigComponent(
            name: 'Tabs',
            data: ['placement' => 'foo'],
        );
    }

    /**
     * @testWith ["lg", "tabs-lg"]
     *           ["md", "tabs-md"]
     *           ["sm", "tabs-sm"]
     *           ["xl", "tabs-xl"]
     *           ["xs", "tabs-xs"]
     */
    public function testSizeProp(string $value, string $expectedCssClass): void
    {
        $rendered = $this->renderTwigComponent(
            name: 'Tabs',
            data: ['size' => $value],
        );

        $this->assertSame("tabs $expectedCssClass", $rendered->crawler()->filter('body > *:first-child')->attr('class'));
    }

    public function testInvalidSizePropThrows(): void
    {
        $this->expectException(\Twig\Error\RuntimeError::class);
        $this->expectExceptionMessageMatches('/option "size" with value "foo" is invalid/i');

        $this->renderTwigComponent(
            name: 'Tabs',
            data: ['size' => 'foo'],
        );
    }

    /**
     * @testWith ["border", "tabs-border"]
     *           ["box", "tabs-box"]
     *           ["lift", "tabs-lift"]
     */
    public function testStyleProp(string $value, string $expectedCssClass): void
    {
        $rendered = $this->renderTwigComponent(
            name: 'Tabs',
            data: ['style' => $value],
        );

        $this->assertSame("tabs $expectedCssClass", $rendered->crawler()->filter('body > *:first-child')->attr('class'));
    }

    public function testInvalidStylePropThrows(): void
    {
        $this->expectException(\Twig\Error\RuntimeError::class);
        $this->expectExceptionMessageMatches('/option "style" with value "foo" is invalid/i');

        $this->renderTwigComponent(
            name: 'Tabs',
            data: ['style' => 'foo'],
        );
    }
}
