<?php

namespace Gremo\DaisyUITwigComponents\Tests\Unit\Twig\Components;

use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\UX\TwigComponent\Test\InteractsWithTwigComponents;

class KbdTest extends KernelTestCase
{
    use InteractsWithTwigComponents;

    public function testRenderingWithDefaults(): void
    {
        $rendered = $this->renderTwigComponent(
            name: 'Kbd',
            data: [],
        );

        $body = $rendered->crawler()->children('body');
        $this->assertCount(1, $body->children());

        $el = $body->children()->first();
        $this->assertSame('kbd', $el->attr('class'));
    }

    /**
     * @testWith [null, "div"]
     *           ["span", "span"]
     */
    public function testAsProp(?string $value, string $expectedNodeName): void
    {
        $rendered = $this->renderTwigComponent(
            name: 'Kbd',
            data: null !== $value ? ['as' => $value] : [],
        );

        $el = $rendered->crawler()->filter('body > *:first-child');
        $this->assertSame($expectedNodeName, $el->nodeName());
    }

    /**
     * @testWith [{"content": "<b>foo</b>"}, "<b>foo</b>"]
     *           [{"data": {"content": "foo"}}, "foo"]
     */
    public function testCanRenderContent(array $data, string $expectedContent): void
    {
        $rendered = $this->renderTwigComponent(
            name: 'Kbd',
            data: $data['data'] ?? [],
            content: $data['content'] ?? null,
        );

        $el = $rendered->crawler()->filter('body > *:first-child');
        $this->assertStringContainsString($expectedContent, $el->html());
    }

    public function testCanRenderAttributes(): void
    {
        $rendered = $this->renderTwigComponent(
            name: 'Kbd',
            data: ['foo' => 'bar'],
        );

        $el = $rendered->crawler()->filter('body > *:first-child');
        $this->assertSame('bar', $el->attr('foo'));
    }

    /**
     * @testWith [null, "kbd"]
     *           ["", "kbd"]
     *           ["lg", "kbd kbd-lg"]
     *           ["md", "kbd kbd-md"]
     *           ["sm", "kbd kbd-sm"]
     *           ["xs", "kbd kbd-xs"]
     */
    public function testSizeProp(?string $value, string $expectedCass): void
    {
        $rendered = $this->renderTwigComponent(
            name: 'Kbd',
            data: ['size' => $value],
        );

        $el = $rendered->crawler()->filter('body > *:first-child');
        $this->assertSame($expectedCass, $el->attr('class'));
    }
}
