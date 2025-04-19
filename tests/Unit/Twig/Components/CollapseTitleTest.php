<?php

namespace Gremo\DaisyUITwigComponents\Tests\Unit\Twig\Components;

use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\UX\TwigComponent\Test\InteractsWithTwigComponents;

class CollapseTitleTest extends KernelTestCase
{
    use InteractsWithTwigComponents;

    public function testRenderWithoutData(): void
    {
        $rendered = $this->renderTwigComponent(
            name: 'CollapseTitle',
            data: [],
        );

        $body = $rendered->crawler()->children('body');
        $this->assertCount(1, $body->children());

        $el = $body->children()->first();
        $this->assertSame('div', $el->nodeName());
        $this->assertSame('collapse-title', $el->attr('class'));
    }

    public function testRenderWithData(): void
    {
        $rendered = $this->renderTwigComponent(
            name: 'CollapseTitle',
            data: [
                'id' => 'my-collapse-title',
                'class' => 'collapse-title-class',
                'data-controller' => 'collapse-title',
            ],
        );

        $el = $rendered->crawler()->filter('body > *:first-child');

        $this->assertSame('my-collapse-title', $el->attr('id'));
        $this->assertSame('collapse-title collapse-title-class', $el->attr('class'));
        $this->assertSame('collapse-title', $el->attr('data-controller'));
    }

    public function testAsProp(): void
    {
        $rendered = $this->renderTwigComponent(
            name: 'CollapseTitle',
            data: ['as' => 'h1'],
        );

        $el = $rendered->crawler()->filter('body > *:first-child');

        $this->assertSame('h1', $el->nodeName());
    }

    /**
     * @testWith ["foo", null, "foo"]
     *           [null, "<b>bar</b>", "<b>bar</b>"]
     *           ["foo", "<b>bar</b>", "<b>bar</b>"]
     */
    public function testContentPropOrSlot(?string $propContent, ?string $slotContent, string $expectedContent): void
    {
        $rendered = $this->renderTwigComponent(
            name: 'CollapseTitle',
            data: null !== $propContent ? ['content' => $propContent] : [],
            content: $slotContent
        );

        $this->assertSame($expectedContent, trim($rendered->crawler()->filter('body > *:first-child')->html()));
    }
}
