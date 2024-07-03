<?php

namespace Gremo\DaisyUITwigComponents\Tests\Unit\Twig\Components;

use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\UX\TwigComponent\Test\InteractsWithTwigComponents;

class CollapseTest extends KernelTestCase
{
    use InteractsWithTwigComponents;

    /**
     * @dataProvider getTestHtmlTreeProps
     */
    public function testCreateHtmlTree(array $props): void
    {
        $rendered = $this->renderTwigComponent(
            name: 'Collapse',
            data: $props,
        );

        $collapse = $rendered->crawler()->filter("body > div");

        $this->assertSame('collapse', $collapse->attr('class'));
        if ($props['autoClose'] ?? false) {
            $this->assertSame('0', $collapse->attr('tabindex'));
        } else {
            $input = $collapse->children()->first();
            $this->assertSame('input', $input->nodeName());
            $this->assertSame('checkbox', $input->attr('type'));
        }

        $this->assertSame(1, $collapse->children('.collapse-title')->count());
        $this->assertSame(1, $collapse->children('.collapse-content')->count());
    }

    /**
     * @depends testCreateHtmlTree
     * @dataProvider getTestTitleProps
     */
    public function testTitleProp(array $props, string $expectedTitle): void
    {
        $rendered = $this->renderTwigComponent(
            name: 'Collapse',
            data: $props['data'] ?? [],
            blocks: $props['blocks'] ?? [],
        );

        $collapse = $rendered->crawler()->filter("body > div");

        $this->assertStringContainsString($expectedTitle, $collapse->children('.collapse-title')->text());
    }

    /**
     * @depends testCreateHtmlTree
     * @dataProvider getTestIconProps
     */
    public function testIconProp(array $props, ?string $expectedClass): void
    {
        $rendered = $this->renderTwigComponent(
            name: 'Collapse',
            data: $props['data'] ?? [],
            blocks: $props['blocks'] ?? [],
        );

        $collapse = $rendered->crawler()->filter("body > div");

        if (null !== $expectedClass) {
            $this->assertStringContainsString($expectedClass, $collapse->attr('class'));
        } else {
            $this->assertSame('collapse', $collapse->attr('class'));
        }
    }

    /**
     * @depends testCreateHtmlTree
     */
    public function testNestedAttributes(): void
    {
        $rendered = $this->renderTwigComponent(
            name: 'Collapse',
            data: [
                'title:class' => 'foo',
                'title:foo' => 'bar',
                'content:class' => 'foo',
                'content:foo' => 'bar',
            ],
        );

        $collapse = $rendered->crawler()->filter("body > div");

        $title = $collapse->children('.collapse-title');
        $content = $collapse->children('.collapse-content');

        $this->assertStringContainsString('foo', $title->attr('class'));
        $this->assertSame('bar', $title->attr('foo'));
        $this->assertStringContainsString('foo', $content->attr('class'));
        $this->assertSame('bar', $content->attr('foo'));
    }

    public function getTestHtmlTreeProps(): iterable
    {
        yield [[]];

        yield [[
            'autoClose' => true,
        ]];
    }

    public function getTestTitleProps(): iterable
    {
        yield [['data' => ['title' => 'foo']], 'foo'];

        yield [['blocks' => ['title' => 'foo']], 'foo'];

        yield [['data' => ['title' => 'foo'], 'blocks' => ['title' => 'bar']], 'foo'];
    }

    public function getTestIconProps(): iterable
    {
        yield [['data' => ['icon' => 'foo']], null];

        yield [['data' => ['icon' => 'arrow']], 'collapse-arrow'];

        yield [['data' => ['icon' => 'plus']], 'collapse-plus'];
    }
}
