<?php

namespace Gremo\DaisyUITwigComponents\Tests\Unit\Twig\Components;

use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\UX\TwigComponent\Test\InteractsWithTwigComponents;

class RadialProgressTest extends KernelTestCase
{
    use InteractsWithTwigComponents;

    public function testRenderWithoutData(): void
    {
        $rendered = $this->renderTwigComponent(
            name: 'RadialProgress',
            data: [
                'value' => 80,
            ],
        );

        $body = $rendered->crawler()->children('body');
        $this->assertCount(1, $body->children());

        $el = $body->children()->first();
        $this->assertSame('div', $el->nodeName());
        $this->assertSame('radial-progress', $el->attr('class'));
        $this->assertSame('progressbar', $el->attr('role'));
        $this->assertSame('80', $el->attr('aria-valuenow'));

        $style = $el->attr('style');
        $this->assertStringContainsString('--value:80;', $style);
        $this->assertStringNotContainsString('--size', $style);
        $this->assertStringNotContainsString('--thickness', $style);
    }

    public function testRenderWithData(): void
    {
        $rendered = $this->renderTwigComponent(
            name: 'RadialProgress',
            data: [
                'id' => 'my-progress',
                'class' => 'progress-custom',
                'data-controller' => 'drawer-controller',
                'value' => 80,
                'size' => '3rem',
                'thickness' => '2px',
            ],
        );

        $el = $rendered->crawler()->filter('body > *:first-child');

        $this->assertSame('my-progress', $el->attr('id'));
        $this->assertSame('radial-progress progress-custom', $el->attr('class'));
        $this->assertSame('drawer-controller', $el->attr('data-controller'));

        $style = $el->attr('style');
        $this->assertStringContainsString('--size:3rem;', $style);
        $this->assertStringContainsString('--thickness:2px;', $style);
    }

    public function testAsProp(): void
    {
        $rendered = $this->renderTwigComponent(
            name: 'RadialProgress',
            data: [
                'as' => 'span',
                'value' => 80,
            ],
        );

        $el = $rendered->crawler()->filter('body > *:first-child');

        $this->assertSame('span', $el->nodeName());
    }

    public function testContentSlot(): void
    {
        $rendered = $this->renderTwigComponent(
            name: 'RadialProgress',
            data: [
                'value' => 50,
            ],
            content: '<b>50%</b>',
        );

        $el = $rendered->crawler()->filter('body > *:first-child');

        $this->assertSame('<b>50%</b>', trim($el->children()->last()->outerHtml()));
    }

    /**
     * @testWith ["50", "foo", null, "foo"]
     *           ["70", null, "<b>bar</b>", "<b>bar</b>"]
     *           ["15", "foo", "<b>bar</b>", "<b>bar</b>"]
     *           ["20", null, null, "20"]
     */
    public function testContentPropOrSlot(?string $value, ?string $propContent, ?string $slotContent, string $expectedContent): void
    {
        $rendered = $this->renderTwigComponent(
            name: 'RadialProgress',
            data: [
                'value' => $value,
                ...(null !== $propContent ? ['content' => $propContent] : []),
            ],
            content: $slotContent
        );

        $this->assertSame($expectedContent, trim($rendered->crawler()->filter('body > *:first-child')->html()));
    }
}
