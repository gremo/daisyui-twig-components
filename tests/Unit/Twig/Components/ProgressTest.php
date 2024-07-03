<?php

namespace Gremo\DaisyUITwigComponents\Tests\Unit\Twig\Components;

use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\UX\TwigComponent\Test\InteractsWithTwigComponents;

class ProgressTest extends KernelTestCase
{
    use InteractsWithTwigComponents;

    public function testRenderingWithDefaults(): void
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
    }

    /**
     * @testWith ["foo", "foo"]
     */
    public function testCannotRenderContent(string $value, string $expectedContent): void
    {
        $rendered = $this->renderTwigComponent(
            name: 'Progress',
            content: $value,
        );

        $el = $rendered->crawler()->filter('body > *:first-child');
        $this->assertStringNotContainsString($expectedContent, $el->html());
    }

    public function testCanRenderAttributes(): void
    {
        $rendered = $this->renderTwigComponent(
            name: 'Progress',
            data: ['foo' => 'bar'],
        );

        $el = $rendered->crawler()->filter('body > *:first-child');
        $this->assertSame('bar', $el->attr('foo'));
    }

    /**
     * @testWith [null, "progress"]
     *           ["", "progress"]
     *           ["primary", "progress progress-primary"]
     *           ["secondary", "progress progress-secondary"]
     *           ["accent", "progress progress-accent"]
     *           ["info", "progress progress-info"]
     *           ["success", "progress progress-success"]
     *           ["warning", "progress progress-warning"]
     *           ["error", "progress progress-error"]
     */
    public function testThemeProp(?string $value, string $expectedCass): void
    {
        $rendered = $this->renderTwigComponent(
            name: 'Progress',
            data: ['theme' => $value],
        );

        $el = $rendered->crawler()->filter('body > *:first-child');
        $this->assertSame($expectedCass, $el->attr('class'));
    }
}
