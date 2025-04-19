<?php

namespace Gremo\DaisyUITwigComponents\Tests\Unit\Twig\Components;

use Gremo\DaisyUITwigComponents\Twig\Components\Dropdown;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\UX\TwigComponent\Test\InteractsWithTwigComponents;

class DropdownTest extends KernelTestCase
{
    use InteractsWithTwigComponents;

    public function testMount(): void
    {
        $component = $this->mountTwigComponent(
            name: 'Dropdown',
            data: [],
        );

        $this->assertInstanceOf(Dropdown::class, $component);
        $this->assertNull($component->placement);
        $this->assertSame('focus', $component->trigger);
        $this->assertFalse($component->open);

        $toggleAttrs = $component->getToggleAttributes();
        $this->assertTrue($toggleAttrs->has('as'));
        $this->assertSame('div', $toggleAttrs->all()['as']);
        $this->assertTrue($toggleAttrs->has('role'));
        $this->assertSame('button', $toggleAttrs->all()['role']);
        $this->assertTrue($toggleAttrs->has('tabindex'));
        $this->assertSame(0, $toggleAttrs->all()['tabindex']);
    }

    public function testRenderWithoutData(): void
    {
        $rendered = $this->renderTwigComponent(
            name: 'Dropdown',
            data: [],
        );

        $body = $rendered->crawler()->children('body');

        $this->assertCount(1, $body->children());

        $el = $body->children()->first();

        $this->assertSame('div', $el->nodeName());
        $this->assertSame('dropdown', $el->attr('class'));
        $this->assertEmpty($el->innerText());
    }

    public function testRenderWithData(): void
    {
        $rendered = $this->renderTwigComponent(
            name: 'Dropdown',
            data: [
                'trigger' => 'click',
            ],
        );

        $body = $rendered->crawler()->children('body');

        $this->assertCount(1, $body->children());

        $el = $body->children()->first();

        $this->assertSame('details', $el->nodeName());
        $this->assertSame('dropdown', $el->attr('class'));
        $this->assertEmpty($el->innerText());
    }

    /**
     * @testWith ["center", "dropdown-center"]
     *           ["end", "dropdown-end"]
     *           ["start", "dropdown-start"]
     */
    public function testAlignProp(string $value, string $expectedCssClass): void
    {
        $rendered = $this->renderTwigComponent(
            name: 'Dropdown',
            data: ['align' => $value],
        );

        $this->assertSame("dropdown $expectedCssClass", $rendered->crawler()->filter('body > *:first-child')->attr('class'));
    }

    public function testInvalidAlignPropThrows(): void
    {
        $this->expectException(\Twig\Error\RuntimeError::class);
        $this->expectExceptionMessageMatches('/option "align" with value "foo" is invalid/i');

        $this->renderTwigComponent(
            name: 'Dropdown',
            data: ['align' => 'foo'],
        );
    }

    /**
     * @testWith ["bottom", "dropdown-bottom"]
     *           ["left", "dropdown-left"]
     *           ["right", "dropdown-right"]
     *           ["top", "dropdown-top"]
     */
    public function testPlacementProp(string $value, string $expectedCssClass): void
    {
        $rendered = $this->renderTwigComponent(
            name: 'Dropdown',
            data: ['placement' => $value],
        );

        $this->assertSame("dropdown $expectedCssClass", $rendered->crawler()->filter('body > *:first-child')->attr('class'));
    }

    public function testInvaliPlacementPropThrows(): void
    {
        $this->expectException(\Twig\Error\RuntimeError::class);
        $this->expectExceptionMessageMatches('/option "placement" with value "foo" is invalid/i');

        $this->renderTwigComponent(
            name: 'Dropdown',
            data: ['placement' => 'foo'],
        );
    }
}
